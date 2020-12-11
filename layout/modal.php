<!-- Rate Modal -->
<div id="rate-modal" class="modal fade rate-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="score-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="score-option">Your Score</label>
                        <select class="form-control custom-select-sm" id="score-option" name="score">
                            <option value="0" disabled selected>Select</option>
                            <option value="10">(10) Perfect!</option>
                            <option value="9">(9) Awesome</option>
                            <option value="8">(8) Great</option>
                            <option value="7">(7) Good</option>
                            <option value="6">(6) Not Bad</option>
                            <option value="5">(5) Need Development</option>
                            <option value="4">(4) Boring</option>
                            <option value="3">(3) Bad</option>
                            <option value="2">(2) Horrible</option>
                            <option value="1">(1) GTFO!</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                    <input type="hidden" name="operation" id="rate-action">
                    <input type="hidden" name="id" id="rate-id">
                    <input type="hidden" name="character" id="rate-character" value="<?php if(isset($_GET['id'])) { echo $row['character_id']; } ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-favorites">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- My Score Modal -->
<?php if(isset($_GET['name'])): ?>
<div id="scoreModal" class="modal fade rate-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">My Score List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-list-score">
                        <tr>
                            <td>#</td>
                            <td>Characters</td>
                            <td>Score</td>
                        </tr>
                        <?php require_once('index.rating.php'); ?>
                        <?php foreach($myRating as $rated): ?>
                        <tr>
                            <td><?= $noRating ?></td>
                            <td><a href="../character/<?= $rated['character_id'] ?>"><?= $rated['character_fullname'] ?></a></td>
                            <td><?= $rated['rate'] ?></td>
                        </tr>
                        <?php $noRating++ ?>
                        <?php endforeach ?>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif ?>

<!-- Add Characters -->
<div id="charaModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Character</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="charaForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="quotes" class="col-sm-2 col-form-label">Faceclaim</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="faceclaim" name="faceclaim" accept="image/x-png,image/gif,image/jpeg"
                                    required>
                                <label class="custom-file-label" for="faceclaim">Choose Faceclaim</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-0">
                        <div class="col-sm-12">
                            <span id="upload-faceclaim"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mt-1">
                            <input type="text" class="form-control form-control-sm" id="character-source" placeholder="Character name in faceclaim"
                                name="source" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="fullname" placeholder="Fullname"
                                name="fullname" required>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="nickname" placeholder="Nickname"
                                name="nickname" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10 mt-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="chara-male" value="M"
                                    required>
                                <label class="form-check-label" for="chara-male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="chara-female" value="F"
                                    required>
                                <label class="form-check-label" for="chara-female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="chara-other" value="O"
                                    required>
                                <label class="form-check-label" for="chara-other">Other</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="text" class="form-control form-control-sm" id="first-appearance" placeholder="First Appearance Format = ' Chapter berapa(Nama Roleplay) '"
                                name="first_appearance">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea rows="2" class="form-control form-control-sm" id="quotes" placeholder="Featured Quotes"
                                name="quotes"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mt-1">
                            <select class="form-control form-control-sm" name="race" id="race" required>
                                <option value="" disabled selected>Select your race</option>
                                <?php require_once('../content/race.php'); ?>
                                <?php foreach($resultRace as $data): ?>
                                <option value="<?=$data->race_id ?>">
                                    <?=$data->race_name?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="age" placeholder="Age" name="age"
                                required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="school" placeholder="School"
                                name="school">
                        </div>
                        <div class="col-sm-6 mt-1">
                            <select class="form-control form-control-sm" name="partner" id="partner">
                                <option value="" disabled selected>Partner</option>
                                <option value="">—</option>
                                <?php require_once('../content/character.php'); ?>
                                <?php foreach($resultChara as $data): ?>
                                <option value="<?=$data->character_id ?>">
                                    <?=$data->character_fullname?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea rows="3" class="form-control form-control-sm" id="storyline" placeholder="Storyline or Background"
                                name="storyline"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea rows="2" class="form-control form-control-sm" id="personality" placeholder="Personality"
                                name="personality"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea rows="2" class="form-control form-control-sm" id="appearance" placeholder="Appearance"
                                name="appearance"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="character_id" id="character-id">
                    <input type="hidden" name="operation" id="character-operation">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="action-button-character" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Tambah Roleplay untuk Karakter -->
<div id="list-roleplay-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Roleplay</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="list-roleplay-table"></div>
            <form id="list-roleplay-form" method="POST">
                <div class="modal-body">
                    <div class="row mb-2">
                        <label class="col-sm-12 col-form-label">Tambahkan Roleplay pada Karakter</label>
                    </div>
                    <div class="form-group row mt-0">
                        <div class="col-sm-6 mb-2">
                            <select class="form-control form-control-sm" name="roleplay" id="roleplay-character-name"
                                required>
                                <option value="" selected disabled>Roleplay</option>
                                <?php require_once('../content/roleplay.php'); ?>
                                <?php foreach($resultRoleplay as $data): ?>
                                <option value="<?=$data->roleplay_id ?>">
                                    <?=$data->roleplay_name?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control form-control-sm" name="role" id="role" required>
                                <option value="" selected disabled>Role</option>
                                <option value="Main">Main</option>
                                <option value="Supporting">Supporting</option>
                                <option value="Guest">Guest</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="character_id" id="list-character-id">
                    <button type="submit" class="btn hor-grd btn-favorites">Tambah</button>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn hor-grd btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

