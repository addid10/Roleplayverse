(function ($) {
    "use strict";

    function AssetManager() {
        this.successCount = 0;
        this.errorCount = 0;
        this.cache = {};
        this.downloadQueue = [];
    }

    AssetManager.prototype.queueDownload = function (options) {
        var oSettings = $.extend({
            type: "image"
        }, options);

        this.downloadQueue.push(oSettings);
    };

    AssetManager.prototype.downloadAll = function (callback) {
        if (this.downloadQueue.length === 0) {
            if (callback) {
                callback();
            }
        }

        for (var i = 0; i < this.downloadQueue.length; i++) {
            var download = this.downloadQueue[i];
            var path = download.path;
            var that = this;

            switch (download.type) {
                case "image":
                    var img = new Image();
                    img.addEventListener("load", function () {
                        that.successCount += 1;
                        if (that.isDone()) {
                            if (callback) {
                                callback();
                            }
                        }
                    }, false);
                    img.addEventListener("error", function () {
                        that.errorCount += 1;
                        if (that.isDone()) {
                            if (callback) {
                                callback();
                            }
                        }
                    }, false);
                    img.src = path;
                    this.cache[path] = img;
                    break;
                case "audio":
                    var audio = new Audio();
                    audio.addEventListener("loadeddata", function () {
                        that.successCount += 1;
                        if (that.isDone()) {
                            if (callback) {
                                callback();
                            }
                        }
                    }, false);
                    audio.addEventListener("error", function () {
                        that.errorCount += 1;
                        if (that.isDone()) {
                            if (callback) {
                                callback();
                            }
                        }
                    }, false);
                    audio.src = path;
                    this.cache[path] = audio;
                    break;
                default:
                    console.log("Unknown Asset Type: " + download.type);
                    break;
            }
        }
    };

    AssetManager.prototype.getAsset = function (path) {
        return this.cache[path];
    };

    AssetManager.prototype.isDone = function () {
        return ((this.downloadQueue.length) == this.successCount + this.errorCount);
    };

    var methods = {
        init: function (options) {

            return this.each(function () {

                var $this = $(this);
                var data = $this.data('iaae');
                var oSettings = new Object();

                $this.addClass('iaae');

                if (options.useLocalStorage) {
                    var localStorage = (typeof window.localStorage[options.id_tag] === "undefined" ? new Object() : JSON.parse(window.localStorage[options.id_tag]));

                    oSettings = $.extend({
                        id_tag: "default",
                        current_frame_id: (typeof localStorage.current_frame_id === "undefined" ? 0 : localStorage.current_frame_id),
                        width: 960,
                        height: 540,
                        asset_images: "./assets/images/",
                        asset_audio: "./assets/audio/",
                        frames: [],
                        labels: new Object(),
                        graphic_assets: [],
                        audio_assets: [],
                        memory: (typeof localStorage.memory === "undefined" ? new Object() : localStorage.memory),
                        saves: (typeof localStorage.saves === "undefined" ? new Array() : localStorage.saves),
                        music: (typeof localStorage.music === "undefined" ? new Array() : localStorage.music),
                        volume_music: (typeof localStorage.volume_music === "undefined" ? 1 : localStorage.volume_music),
                        volume_voice: (typeof localStorage.volume_voice === "undefined" ? 1 : localStorage.volume_voice),
                        volume_effect: (typeof localStorage.volume_effect === "undefined" ? 1 : localStorage.volume_effect)
                    }, options);
                } else {
                    oSettings = $.extend({
                        id_tag: "default",
                        current_frame_id: 0,
                        width: 960,
                        height: 540,
                        asset_images: "./assets/images/",
                        asset_audio: "./assets/audio/",
                        frames: [],
                        labels: new Object(),
                        graphic_assets: [],
                        audio_assets: [],
                        memory: new Object(),
                        saves: new Array(),
                        music: new Array(),
                        volume_music: 1,
                        volume_voice: 1,
                        volume_effect: 1
                    }, options);
                }

                // If the plugin hasn't been initialized yet
                if (!data) {

                    $this.data('iaae', {
                        target: $this,
                        settings: oSettings,
                        asset_manager: new AssetManager()
                    });

                    $this.width(oSettings.width);
                    $this.height(oSettings.height);
                    $this.css("overflow", "hidden");
                    $this.css("position", "relative");

                    $this.data('iaae').settings.graphic_assets.forEach(function (element) {
                        $this.data('iaae').asset_manager.queueDownload({
                            path: $this.data('iaae').settings.asset_images + element,
                            type: "image"
                        });
                    });

                    $this.data('iaae').settings.audio_assets.forEach(function (element) {
                        $this.data('iaae').asset_manager.queueDownload({
                            path: $this.data('iaae').settings.asset_audio + element,
                            type: "audio"
                        });
                    });

                    $this.data('iaae').asset_manager.downloadAll(function () {
                        $this.iaae('load', {
                            frame_id: 0,
                            updateCurrent: false,
                            updateLocalStorage: false
                        });
                    });
                }
            });
        },
        load: function (oOptions) {
            var options = $.extend({
                frame_id: 0,
                clear: true,
                updateCurrent: true,
                updateLocalStorage: true
            }, oOptions);

            return this.each(function () {
                var $this = $(this);

                if (options.clear) {
                    $this.iaae('clear');
                }

                if (options.updateCurrent) {
                    $this.data('iaae').settings.current_frame_id = options.frame_id;
                }

                $this.data('iaae').current_frame = $this.data('iaae').settings.frames[options.frame_id];

                if (options.updateLocalStorage) {
                    var storage = (typeof window.localStorage.getItem($this.data('iaae').settings.id_tag)) === "undefined" || window.localStorage.getItem($this.data('iaae').settings.id_tag) === null ? new Object() : JSON.parse(window.localStorage.getItem($this.data('iaae').settings.id_tag));
                    storage.current_frame_id = $this.data('iaae').settings.current_frame_id;
                    storage.memory = $this.data('iaae').settings.memory;
                    storage.music = $this.data('iaae').settings.music;
                    storage.volume_music = $this.data('iaae').settings.volume_music;
                    storage.volume_voice = $this.data('iaae').settings.volume_voice;
                    storage.volume_effect = $this.data('iaae').settings.volume_effect;

                    window.localStorage.setItem($this.data('iaae').settings.id_tag, JSON.stringify(storage));
                }

                $this.data('iaae').current_frame();
            });
        },
        clear: function () {
            return this.each(function () {
                var $target = $(this);
                $target.find(":animated").finish();
                $target.unbind();
                $target.empty();
            });
        }
    };

    $.fn.iaae = function (method) {

        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.iaae');
            return this;
        }
    };
})(jQuery);

/**
The MIT License (MIT)

Copyright (c) 2013 Matthew Urtnowski

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
**/
$(document).ready(function () {
    var standardFrame = function (options) {
        var $target = $(options.this.target);

        if (options.background) {
            var background = options.this.asset_manager.getAsset(options.this.settings.asset_images + options.background.src).cloneNode();
            background.className = "fill-image";
            $target.append(background);
        }

        if (options.character) {
            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";
            var characterImg = options.this.asset_manager.getAsset(options.this.settings.asset_images + options.character.src).cloneNode();
            characterDiv.appendChild(characterImg);
            $target.append(characterDiv);
        }

        if (options.characterLeft) {
            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div left";
            var characterImg = options.this.asset_manager.getAsset(options.this.settings.asset_images + options.characterLeft.src).cloneNode();
            characterDiv.appendChild(characterImg);
            $target.append(characterDiv);
        }

        if (options.characterRight) {
            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div right";
            var characterImg = options.this.asset_manager.getAsset(options.this.settings.asset_images + options.characterRight.src).cloneNode();
            characterDiv.appendChild(characterImg);
            $target.append(characterDiv);
        }

        $target.click(function () {
            $target.iaae('load', {
                frame_id: $target.data('iaae').settings.current_frame_id + 1
            });
        });

        if (options.text) {
            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html(options.text);

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = options.this.asset_manager.getAsset(options.this.settings.asset_images + "floppy.png").cloneNode();

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = options.this.asset_manager.getAsset(options.this.settings.asset_images + "home.png").cloneNode();

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        }
    };

    var labels = new Object();

    var frames = [
        function () {

            var $target = $(this.target);

            //$target.css('background-image', "url(" + this.settings.asset_images + "menu.jpg)");
            $target.css('background-color', 'black');
            //$target.css('background-position', "center");
            //$target.css('background-repeat', "no-repeat");
            //$target.css('background-size', "contain");

            var backgroundDiv = document.createElement('div');
            backgroundDiv.style.position = "absolute";
            backgroundDiv.style.bottom = "0px";
            backgroundDiv.style.left = "50%";

            var background = this.asset_manager.getAsset(this.settings.asset_images + "menu.jpg").cloneNode();
            //background.style.width = "100%"
            background.style.height = "100%"
            background.style.position = "relative";
            background.style.left = "-50%";

            $target.append(backgroundDiv);
            $(backgroundDiv).append(background);

            var well = document.createElement('div');
            well.className = 'well';
            well.style.position = 'absolute';
            well.style.top = '350px';
            well.style.left = '600px';

            $target.append(well);

            var btnStack = document.createElement('ul');
            btnStack.className = 'btn-stack';

            $(well).append(btnStack);

            var btn1 = document.createElement('li');
            btn1.className = 'btn';
            btn1.innerHTML = 'Start Game';

            $(btnStack).append(btn1);
            $(btn1).click(function () {
                $target.data('iaae').settings.memory = new Object();
                $target.data('iaae').settings.memory.bl_game = false;
                $(btn1).unbind('click');
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }

                var fadeDiv = document.createElement('div');
                fadeDiv.className = "fade-div";
                fadeDiv.style.opacity = "0";

                $target.append(fadeDiv);
                $(fadeDiv).animate({
                    opacity: 1
                }, 1000, function () {
                    $target.iaae('load', {
                        frame_id: $target.data('iaae').settings.labels.start
                    });
                });
            });

            if ($target.data('iaae').settings.current_frame_id != 0) {
                var btn2 = document.createElement('li');
                btn2.className = 'btn';
                btn2.innerHTML = 'Resume';

                $(btnStack).append(btn2);
                $(btn2).click(function () {
                    if (event && event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    } else {
                        console.log("Can't stop events");
                    }
                    $target.iaae('load', {
                        frame_id: $target.data('iaae').settings.current_frame_id
                    });
                });
            }

            var btn3 = document.createElement('li');
            btn3.className = 'btn';
            btn3.innerHTML = 'Load Game';

            $(btnStack).append(btn3);
            $(btn3).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.load,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            var btn4 = document.createElement('li');
            btn4.className = 'btn';
            btn4.innerHTML = 'Preferences';

            $(btnStack).append(btn4);
            $(btn4).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.preferences,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            var btn5 = document.createElement('li');
            btn5.className = 'btn';
            btn5.innerHTML = 'Help';

            $(btnStack).append(btn5);
            $(btn5).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.help,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            //$target.append("<div class='well'><ul class='btn-stack'><li class='btn' style=''>Start Game</li><li class='btn' style='cursor: hand; margin: 2px 10px; border-radius: 11px; padding: 2px 5px; color: #581A00; font-size: 22px; font-family:\"Lucida Console\"'>Load Game</li><li class='btn' class='btn' style='cursor: hand; margin: 2px 10px; border-radius: 11px; padding: 2px 5px; color: #581A00; font-size: 22px; font-family:\"Lucida Console\"'>Preferences</li><li class='btn' style='cursor: hand; margin: 2px 10px; border-radius: 11px; padding: 2px 5px; color: #581A00; font-size: 22px; font-family:\"Lucida Console\"'>Help</li></ul></div>");
        },
        labels.load = function () {
            var $target = $(this.target);

            var backgroundDiv = document.createElement('div');
            backgroundDiv.style.position = "absolute";
            backgroundDiv.style.bottom = "0px";
            backgroundDiv.style.left = "50%";

            var background = this.asset_manager.getAsset(this.settings.asset_images + "menu2.jpg").cloneNode();
            //background.style.width = "100%"
            background.style.height = "100%"
            background.style.position = "relative";
            background.style.left = "-50%";

            $target.append(backgroundDiv);
            $(backgroundDiv).append(background);

            var well = document.createElement('div');
            well.className = 'well';
            well.style.position = 'absolute';
            well.style.top = '0';
            well.style.left = '0';
            well.style.right = '0';
            well.style.marginLeft = '50px';
            well.style.marginRight = '50px';
            well.style.marginTop = '50px';
            well.style.backgroundColor = 'rgba(149,133,15,0.5)';

            $target.append(well);

            $(well).append("<table style='width: 100%'><tbody></tbody></table>");
            for (var i = 0; i < 10; i++) {
                $(well).find("tbody").append("<tr><td style='width: 50%'><div class='btn'></div></td><td style='width: 50%'><div class='btn'></div></td></tr>");
            }

            $(well).find("div.btn").text('No Save');

            $(well).find("div.btn").each(function (index, element) {
                var storage = (typeof window.localStorage.getItem($target.data('iaae').settings.id_tag) === "undefined" || window.localStorage.getItem($target.data('iaae').settings.id_tag) === null ? new Object() : JSON.parse(window.localStorage.getItem($target.data('iaae').settings.id_tag)));

                if (typeof storage.saves === "undefined") {
                    storage.saves = new Array();
                }

                if (storage.saves.length > index && typeof storage.saves[index] !== "undefined" && storage.saves[index] !== null) {
                    $(element).text(storage.saves[index].timestamp);

                    $(element).click(function () {
                        if (event && event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        } else {
                            console.log("Can't stop events");
                        }

                        $target.data('iaae').settings.memory = storage.saves[index].memory;

                        for (var i = 0; i < $target.data('iaae').settings.music.length; i++) {
                            $target.data('iaae').asset_manager.getAsset($target.data('iaae').settings.music[i]).pause();
                            $target.data('iaae').asset_manager.getAsset($target.data('iaae').settings.music[i]).currentTime = 0;
                        }

                        $target.data('iaae').settings.music = storage.saves[index].music;

                        for (var i = 0; i < $target.data('iaae').settings.music.length; i++) {
                            $target.data('iaae').asset_manager.getAsset($target.data('iaae').settings.music[i]).loop = true;
                            $target.data('iaae').asset_manager.getAsset($target.data('iaae').settings.music[i]).volume = $target.data('iaae').settings.volume_music;
                            $target.data('iaae').asset_manager.getAsset($target.data('iaae').settings.music[i]).play();
                        }

                        $target.iaae('load', {
                            frame_id: storage.saves[index].frame
                        });
                    });
                }
            });

            var backBtn = document.createElement('span');
            backBtn.className = 'btn';
            backBtn.innerHTML = "Back";
            backBtn.style.position = 'absolute';
            backBtn.style.right = '10px';
            backBtn.style.bottom = '10px';

            $target.append(backBtn);

            $(backBtn).click(function () {
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });
        },
        labels.save = function () {
            var $target = $(this.target);

            var backgroundDiv = document.createElement('div');
            backgroundDiv.style.position = "absolute";
            backgroundDiv.style.bottom = "0px";
            backgroundDiv.style.left = "50%";

            var background = this.asset_manager.getAsset(this.settings.asset_images + "menu2.jpg").cloneNode();
            //background.style.width = "100%"
            background.style.height = "100%"
            background.style.position = "relative";
            background.style.left = "-50%";

            $target.append(backgroundDiv);
            $(backgroundDiv).append(background);

            var well = document.createElement('div');
            well.className = 'well';
            well.style.position = 'absolute';
            well.style.top = '0';
            well.style.left = '0';
            well.style.right = '0';
            well.style.marginLeft = '50px';
            well.style.marginRight = '50px';
            well.style.marginTop = '50px';
            well.style.backgroundColor = 'rgba(149,133,15,0.5)';

            $target.append(well);

            $(well).append("<table style='width: 100%'><tbody></tbody></table>");
            for (var i = 0; i < 10; i++) {
                $(well).find("tbody").append("<tr><td style='width: 50%'><div class='btn'></div></td><td style='width: 50%'><div class='btn'></div></td></tr>");
            }

            $(well).find("div.btn").text('No Save');

            $(well).find("div.btn").each(function (index, element) {
                var storage = JSON.parse(window.localStorage.getItem($target.data('iaae').settings.id_tag));

                if (typeof storage.saves === "undefined") {
                    storage.saves = new Array();
                }

                if (storage.saves.length > index && typeof storage.saves[index] !== "undefined" && storage.saves[index] !== null) {
                    $(element).text(storage.saves[index].timestamp);
                }

                $(element).click(function () {

                    storage.saves[index] = {
                        timestamp: new Date().toLocaleString(),
                        frame: $target.data('iaae').settings.current_frame_id,
                        memory: $target.data('iaae').settings.memory,
                        music: $target.data('iaae').settings.music
                    };

                    $(element).text(storage.saves[index].timestamp);

                    window.localStorage.setItem($target.data('iaae').settings.id_tag, JSON.stringify(storage));
                });
            });

            var backBtn = document.createElement('span');
            backBtn.className = 'btn';
            backBtn.innerHTML = "Back";
            backBtn.style.position = 'absolute';
            backBtn.style.right = '10px';
            backBtn.style.bottom = '10px';

            $target.append(backBtn);

            $(backBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });
        },
        labels.preferences = function () {
            var $target = $(this.target);

            var backgroundDiv = document.createElement('div');
            backgroundDiv.style.position = "absolute";
            backgroundDiv.style.bottom = "0px";
            backgroundDiv.style.left = "50%";

            var background = this.asset_manager.getAsset(this.settings.asset_images + "menu2.jpg").cloneNode();
            //background.style.width = "100%"
            background.style.height = "100%"
            background.style.position = "relative";
            background.style.left = "-50%";

            $target.append(backgroundDiv);
            $(backgroundDiv).append(background);

            var well = document.createElement('div');
            well.className = 'well';
            well.style.position = 'absolute';
            well.style.top = '0';
            well.style.left = '0';
            well.style.right = '0';
            well.style.marginLeft = '50px';
            well.style.marginRight = '50px';
            well.style.marginTop = '50px';
            well.style.backgroundColor = 'rgba(149,133,15,0.5)';

            $target.append(well);

            var musicVolume = document.createElement("input");
            musicVolume.type = "range";
            musicVolume.min = 0;
            musicVolume.max = 10;
            musicVolume.value = $target.data('iaae').settings.volume_music * 10;

            $(well).append("<span>Music Volume</span>");
            $(well).append(musicVolume);
            $(well).append("<br>");

            $(musicVolume).change(function () {
                $target.data('iaae').settings.volume_music = $(this).val() / 10;

                for (var i = 0; i < $target.data('iaae').settings.music.length; i++) {
                    $target.data('iaae').asset_manager.getAsset($target.data('iaae').settings.music[i]).volume = $target.data('iaae').settings.volume_music;
                }
            });

            var voiceVolume = document.createElement("input");
            voiceVolume.type = "range";
            voiceVolume.min = 0;
            voiceVolume.max = 10;
            voiceVolume.value = $target.data('iaae').settings.volume_voice * 10;

            $(well).append("<span>Voice Volume</span>");
            $(well).append(voiceVolume);
            $(well).append("<br>");

            $(voiceVolume).change(function () {
                $target.data('iaae').settings.volume_voice = $(this).val() / 10;
            });

            var effectVolume = document.createElement("input");
            effectVolume.type = "range";
            effectVolume.min = 0;
            effectVolume.max = 10;
            effectVolume.value = $target.data('iaae').settings.volume_effect * 10;

            $(well).append("<span>Effect Volume</span>");
            $(well).append(effectVolume);
            $(well).append("<br>");

            $(effectVolume).change(function () {
                $target.data('iaae').settings.volume_effect = $(this).val() / 10;
            });

            var backBtn = document.createElement('span');
            backBtn.className = 'btn';
            backBtn.innerHTML = "Back";
            backBtn.style.position = 'absolute';
            backBtn.style.right = '10px';
            backBtn.style.bottom = '10px';

            $target.append(backBtn);

            $(backBtn).click(function () {
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });
        },
        labels.help = function () {
            var $target = $(this.target);

            var backgroundDiv = document.createElement('div');
            backgroundDiv.style.position = "absolute";
            backgroundDiv.style.bottom = "0px";
            backgroundDiv.style.left = "50%";

            var background = this.asset_manager.getAsset(this.settings.asset_images + "menu2.jpg").cloneNode();
            //background.style.width = "100%"
            background.style.height = "100%"
            background.style.position = "relative";
            background.style.left = "-50%";

            $target.append(backgroundDiv);
            $(backgroundDiv).append(background);

            var well = document.createElement('div');
            well.className = 'well';
            well.style.position = 'absolute';
            well.style.top = '0';
            well.style.left = '0';
            well.style.right = '0';
            well.style.marginLeft = '50px';
            well.style.marginRight = '50px';
            well.style.marginTop = '50px';
            well.style.backgroundColor = 'rgba(149,133,15,0.5)';

            $target.append(well);

            $(well).append("<p>There is no help.  You are all alone and no one is coming to save you.  You are likely to be eaten by a grue.</p>");
            $(well).append("<p>Welcome to the demo for the <b>Incredible Awesome Adventure Engine</b>, a browser based visual novel engine powered javascript and the document object model.  I ported <b>The Question</b> from <b>Ren'Py</b> over to see how it works.  The engine is far from finished, but this is a pretty good start so far.  It's designed to work with modern browsers and for best performance I suggest using Chrome.  Other browsers such as Internet Explorer are more likely to have bugs.</p>");
            $(well).append("Enjoy.");
            $(well).append("<a style='color: #FFFFFF;' href='https://github.com/Murtnowski/The-Question'>https://github.com/Murtnowski/IAAE</a>");

            var backBtn = document.createElement('span');
            backBtn.className = 'btn';
            backBtn.innerHTML = "Back";
            backBtn.style.position = 'absolute';
            backBtn.style.right = '10px';
            backBtn.style.bottom = '10px';

            $target.append(backBtn);

            $(backBtn).click(function () {
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });
        },
        labels.start = function () {
            var $target = $(this.target);

            this.asset_manager.getAsset(this.settings.asset_audio + "illurock.ogg").loop = true;
            this.asset_manager.getAsset(this.settings.asset_audio + "illurock.ogg").volume = $target.data('iaae').settings.volume_music;
            $target.data('iaae').settings.music[0] = this.settings.asset_audio + "illurock.ogg";
            this.asset_manager.getAsset(this.settings.asset_audio + "illurock.ogg").play();

            var background = this.asset_manager.getAsset(this.settings.asset_images + "lecturehall.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "1";

            $target.append(fadeDiv);

            $(fadeDiv).animate({
                opacity: 0
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "lecturehall.jpg"
                },
                text: "Well, professor Eileen's lecture was interesting."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "lecturehall.jpg"
                },
                text: "I had a lot of other thoughts on my mind."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "lecturehall.jpg"
                },
                text: "And they all ended up with a question."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "lecturehall.jpg"
                },
                text: "A question, I've been meaning to ask someone."
            });
        },
        function () {
            var $target = $(this.target);

            var background = this.asset_manager.getAsset(this.settings.asset_images + "lecturehall.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "0";

            $target.append(fadeDiv);
            $(fadeDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            var background = this.asset_manager.getAsset(this.settings.asset_images + "uni.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "1";

            $target.append(fadeDiv);
            $(fadeDiv).animate({
                opacity: 0
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                text: "When we came out of the university, I saw her."
            });
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var background = this.asset_manager.getAsset(this.settings.asset_images + "uni.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";

            characterDiv.style.opacity = "0";

            var characterImg = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_normal.png").cloneNode();

            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $(characterDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "She was a wonderful person."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "I've known her ever since we were children."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "And she's always been a good friend."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "But..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "Recently..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "I think..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "... that I wanted more."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "More just talking... more than just walking home together when our classes ended."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_normal.png"
                },
                text: "And I decided..."
            });
        },
        function () {
            var $target = $(this.target);

            var background = this.asset_manager.getAsset(this.settings.asset_images + "uni.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            var stackDiv = document.createElement('div');
            stackDiv.style.position = 'absolute';
            stackDiv.style.top = '50%';
            stackDiv.style.left = '20%';
            stackDiv.style.width = '100%';

            $target.append(stackDiv);

            var btnStack = document.createElement('ul');
            btnStack.className = 'btn-stack';
            btnStack.style.position = "relative";
            btnStack.style.top = "-56px";

            $(stackDiv).append(btnStack);

            var btn1 = document.createElement('li');
            btn1.className = 'btn';
            btn1.innerHTML = '... to ask her right away.';
            btn1.style.width = "60%";

            $(btnStack).append(btn1);
            $(btn1).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }

                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.rightaway
                });
            });

            var btn2 = document.createElement('li');
            btn2.className = 'btn';
            btn2.innerHTML = '... to ask her later.';
            btn2.style.width = "60%";

            $(btnStack).append(btn2);
            $(btn2).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $(btn2).unbind('click');

                $target.click(function () {
                    $target.find(':animated').finish();
                });

                var fadeDiv = document.createElement('div');
                fadeDiv.className = "fade-div";
                fadeDiv.style.opacity = "0";

                $target.append(fadeDiv);
                $(fadeDiv).animate({
                    opacity: 1
                }, 1000, function () {
                    $target.iaae('load', {
                        frame_id: $target.data('iaae').settings.labels.later
                    });
                });
            });

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").cloneNode();

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = this.asset_manager.getAsset(this.settings.asset_images + "home.png").cloneNode();

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        labels.later = function () {
            standardFrame({
                this: this,
                text: "And so I decided to ask her later."
            });
        },
        function () {
            standardFrame({
                this: this,
                text: "But I was indecisive."
            });
        },
        function () {
            standardFrame({
                this: this,
                text: "I couldn't ask her that day, and I couldn't ask her later."
            });
        },
        function () {
            standardFrame({
                this: this,
                text: "I guess I will never know now."
            });
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: 0
                });
            });

            $target.append("<div class='textbox'></div>");
            $target.find(".textbox").html(".:. Bad Ending.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").cloneNode();

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = this.asset_manager.getAsset(this.settings.asset_images + "home.png").cloneNode();

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        labels.rightaway = function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Sylvie</h1>Oh, hi, do we walk home together?"
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='me'>Me</h1>Yes..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "uni.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "I said and my voice was already shaking."
            });
        },
        function () {
            var $target = $(this.target);

            var background = this.asset_manager.getAsset(this.settings.asset_images + "uni.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";

            var characterImg = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").cloneNode();

            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "0";

            $target.append(fadeDiv);

            $(fadeDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            var background = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "1";

            $target.append(fadeDiv);

            $(fadeDiv).animate({
                opacity: 0
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                text: "We reached the meadows just outside our hometown."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                text: "Autumn was so beautiful here."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                text: "When we were children, we often played here."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                text: "<h1 class='me'>Me</h1>Hey... ummm..."
            });
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var background = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").cloneNode();
            background.className = "fill-image";

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";

            characterDiv.style.opacity = "0";

            var characterImg = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").cloneNode();

            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $(characterDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "She turned to me and smiled."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "I'll ask her..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='me'>Me</h1>Ummm... will you..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='me'>Me</h1>Will you be my artist for a visual novel?"
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_surprised.png"
                },
                text: "Silence"
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_surprised.png"
                },
                text: "She is shocked. And then..."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Sylvie</h1>Sure, but what is a \"visual novel?\""
            });
        },
        function () {
            var $target = $(this.target);

            var background = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").cloneNode();
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";

            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").src;

            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            var stackDiv = document.createElement('div');
            stackDiv.style.position = 'absolute';
            stackDiv.style.top = '50%';
            stackDiv.style.left = '20%';
            stackDiv.style.width = '100%';

            $target.append(stackDiv);

            var btnStack = document.createElement('ul');
            btnStack.className = 'btn-stack';
            btnStack.style.position = "relative";
            btnStack.style.top = "-56px";

            $(stackDiv).append(btnStack);

            var btn1 = document.createElement('li');
            btn1.className = 'btn';
            btn1.innerHTML = "It's a story with pictures.";
            btn1.style.width = "60%";

            $(btnStack).append(btn1);
            $(btn1).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }

                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.vn
                });
            });

            var btn2 = document.createElement('li');
            btn2.className = 'btn';
            btn2.innerHTML = "It's a hentai game.";
            btn2.style.width = "60%";

            $(btnStack).append(btn2);
            $(btn2).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }

                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.hentai
                });
            });

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        labels.vn = function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Me</h1>It's a story with pictures and music."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Me</h1>And you'll be able to make choices that influence the outcome of the story."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Sylvie</h1>So it's like those choose-your-adventure books?"
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Me</h1>Exactly! I plan on making a small romantic story."
            });
        },
        function () {
            standardFrame({
                this: this,
                background: {
                    src: "meadow.jpg"
                },
                character: {
                    src: "sylvie_smile.png"
                },
                text: "<h1 class='sylvie'>Me</h1>And I figured you could help me... since I know how you like to draw."
            });
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>Well, I can try. I hope I don't disappoint you.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.marry
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Me</h1>You can't disappoint me, you know that.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        labels.hentai = function () {
            var $target = $(this.target);
            $target.data('iaae').settings.memory.bl_game = true;

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Me</h1>Why it's a game with lots of sex.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>You mean, like a boy's love game?");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>I've always wanted to make one of those.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>I'll get right on it!");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";



            characterDiv.style.opacity = "1";

            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $(characterDiv).animate({
                opacity: 0
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("...");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);
            $target.data('iaae').settings.memory.bl_game = true;

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.marry
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Me</h1>That wasn't what I meant!");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        labels.marry = function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "meadow.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "0";

            $target.append(fadeDiv);

            $(fadeDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("--- years later ---");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "1";

            $target.append(fadeDiv);

            $(fadeDiv).animate({
                opacity: 0
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("And so, we became a visual novel creating team.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("We made games and had a lot of fun making them.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            if ($target.data('iaae').settings.memory.bl_game) {
                $target.append("<div class='textbox'></div>");

                $target.find(".textbox").html("Well, apart from that Boy's Love game she insisted on making.");

                var toolbar = document.createElement('div');
                toolbar.className = "toolbar";
                toolbar.style.position = 'absolute';
                toolbar.style.right = '0px';
                toolbar.style.bottom = '0px';

                var saveBtn = document.createElement('span');
                saveBtn.className = 'btn';

                var floppy = new Image();
                floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

                saveBtn.appendChild(floppy);

                $(saveBtn).click(function () {
                    if (event && event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    } else {
                        console.log("Can't stop events");
                    }
                    $target.iaae('load', {
                        frame_id: $target.data('iaae').settings.labels.save,
                        updateCurrent: false,
                        updateLocalStorage: false
                    });
                });

                $(toolbar).append(saveBtn);

                var menuBtn = document.createElement('span');
                menuBtn.className = 'btn';

                var home = new Image();
                home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

                menuBtn.appendChild(home);

                $(menuBtn).click(function () {
                    if (event && event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    } else {
                        console.log("Can't stop events");
                    }
                    $target.iaae('load', {
                        frame_id: 0,
                        updateCurrent: false,
                        updateLocalStorage: false
                    });
                });

                $(toolbar).append(menuBtn);

                $target.append(toolbar);
            } else {
                $target.trigger('click');
            }
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("And one day...");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";



            characterDiv.style.opacity = "0";

            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $(characterDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>Hey...");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>Yes?");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>Marry me!");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>What???");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_surprised.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>Well, don't you love me?");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>I do, actually.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>See? We've been making romantic visual novels, spending time together, helping each other....");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>... and when you give love to others, love will come to you.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_smile.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>Hmmm, that's a nice thought.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>I just made that up.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>But it's good.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>I know. So, will you marry me?");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>Ummm, of course I will. I've actually been meaning to ask you, but since you brought it up...");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>I know, but you are so indecisive, that I thought I'd take the initiative.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_normal.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='me'>Me</h1>I guess... It's all all about asking the right question... at the right time.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";




            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;



            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("<h1 class='sylvie'>Sylvie</h1>It is. But now, stop being theoretical, and give me a kiss!");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            var background = new Image();
            background.src = this.asset_manager.getAsset(this.settings.asset_images + "club.jpg").src;
            background.style.position = "absolute";
            background.style.width = "100%"
            background.style.height = "100%"

            $target.append(background);

            var characterDiv = document.createElement('div');
            characterDiv.className = "character-div";

            var characterImg = new Image();
            characterImg.src = this.asset_manager.getAsset(this.settings.asset_images + "sylvie2_giggle.png").src;

            characterDiv.appendChild(characterImg);

            $target.append(characterDiv);

            $target.click(function () {
                $target.find(':animated').finish();
            });

            var fadeDiv = document.createElement('div');
            fadeDiv.className = "fade-div";
            fadeDiv.style.opacity = "0";

            $target.append(fadeDiv);

            $(fadeDiv).animate({
                opacity: 1
            }, 1000, function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("And we got married shortly after that.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("In fact, we made many more visual novels.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.current_frame_id + 1
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html("And together, we lived happily ever after.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";

            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
        function () {
            var $target = $(this.target);

            $target.click(function () {
                $target.iaae('load', {
                    frame_id: 0
                });
            });

            $target.append("<div class='textbox'></div>");

            $target.find(".textbox").html(".:. Good Ending.");

            var toolbar = document.createElement('div');
            toolbar.className = "toolbar";




            var saveBtn = document.createElement('span');
            saveBtn.className = 'btn';

            var floppy = new Image();
            floppy.src = this.asset_manager.getAsset(this.settings.asset_images + "floppy.png").src;

            saveBtn.appendChild(floppy);

            $(saveBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: $target.data('iaae').settings.labels.save,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(saveBtn);

            var menuBtn = document.createElement('span');
            menuBtn.className = 'btn';

            var home = new Image();
            home.src = this.asset_manager.getAsset(this.settings.asset_images + "home.png").src;

            menuBtn.appendChild(home);

            $(menuBtn).click(function () {
                if (event && event.stopPropagation) {
                    event.stopPropagation();
                } else if (window.event) {
                    window.event.cancelBubble = true;
                } else {
                    console.log("Can't stop events");
                }
                $target.iaae('load', {
                    frame_id: 0,
                    updateCurrent: false,
                    updateLocalStorage: false
                });
            });

            $(toolbar).append(menuBtn);

            $target.append(toolbar);
        },
    ];

    for (var propertyName in labels) {
        labels[propertyName] = frames.indexOf(labels[propertyName]);
    }

    var graphic_assets = [
        "home.png",
        "floppy.png",
        "menu.jpg",
        "menu2.jpg",
        "lecturehall.jpg",
        "uni.jpg",
        "meadow.jpg",
        "club.jpg",
        "sylvie_normal.png",
        "sylvie_giggle.png",
        "sylvie_smile.png",
        "sylvie_surprised.png",
        "sylvie2_normal.png",
        "sylvie2_giggle.png",
        "sylvie2_smile.png",
        "sylvie2_surprised.png"
    ];

    var audio_assets = [
        "illurock.ogg"
    ];

    $("#myCanvas").iaae({
        id_tag: "theQuestion",
        frames: frames,
        labels: labels,
        graphic_assets: graphic_assets,
        audio_assets: audio_assets,
        asset_images: "http://murtnowski.com/iaae/assets/images/",
        asset_audio: "http://murtnowski.com/iaae/assets/audio/",
        useLocalStorage: true
    });
});