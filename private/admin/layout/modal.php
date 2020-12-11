<!-- Add Roleplay -->
<div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="POST">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="roleplay-name" placeholder="Nama Roleplay"
                                name="roleplay_name" required>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="othername" placeholder="Nama Alternatif"
                                name="othername" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cover" class="col-sm-2 col-form-label">Cover / Foto</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cover" name="cover" accept="image/x-png,image/gif,image/jpeg"
                                    required>
                                <label class="custom-file-label" for="cover">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-0">
                        <div class="col-sm-8">
                            <span id="upload-image"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mt-1">
                            <input type="date" class="form-control form-control-sm" id="release-date" placeholder="Tanggal Pembuatan Roleplay"
                                name="release_date" required>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <input type="text" class="form-control form-control-sm" id="creators" placeholder="Admin / Owner / Creator"
                                name="creators" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mt-1">
                            <select class="form-control form-control-sm" name="roleplay_type" id="roleplay-type"
                                required>
                                <option value="" disabled selected>Pilih jenis roleplay</option>
                                <option value="Roleplay Story">Roleplay Story</option>
                                <option value="Free Roleplay">Free Roleplay</option>
                                <option value="Dukre">Dukre</option>
                                <option value="Dushi">Dushi</option>
                                <option value="Dukri">Dukri</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select class="form-control form-control-sm" name="source" id="source" required>
                                <option value="" disabled selected>Sumber pembuatan roleplay</option>
                                <option value="Original">Original</option>
                                <option value="Fandom">Fandom</option>
                            </select>
                        </div>
                    </div>
                    <div id="roleplay-fandom" style="display:none;">
                        <div class="form-group row">
                            <div class="col-sm-12 mt-1">
                                <input type="text" class="form-control form-control-sm" id="fandom" placeholder="Nama Fandom"
                                    name="fandom">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mt-1">
                            <textarea rows="4" class="form-control form-control-sm" id="synopsis" placeholder="Sinopsis Roleplay"
                                name="synopsis" required></textarea>
                        </div>
                    </div>
                    <div id="roleplay-stories" style="display:none;">
                        <div class="form-group row">
                            <div class="col-sm-6 mt-1">
                                <input type="number" class="form-control form-control-sm" id="chapters" placeholder="Jumlah Chapter"
                                    name="chapters">
                            </div>
                            <div class="col-sm-6 mt-1">
                                <select class="form-control form-control-sm" name="roleplay_status" id="roleplay-status">
                                    <option value="" disabled selected>Status roleplay</option>
                                    <option value="COMPLETE">COMPLETE</option>
                                    <option value="ON-GOING">ON-GOING</option>
                                    <option value="ON-HOLD">ON-HOLD</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="genres" class="col-sm-2 col-form-label">Genres</label>
                            <div class="col-sm-10 mt-1">
                                <select multiple class="form-control form-control-sm" name="genres[]" id="genres">
                                    <option value="Action">Action</option>
                                    <option value="Adventure">Adventure</option>
                                    <option value="Comedy">Comedy</option>
                                    <option value="Crime">Crime</option>
                                    <option value="Drama">Drama</option>
                                    <option value="Ecchi">Ecchi</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Game">Game</option>
                                    <option value="Historical">Historical</option>
                                    <option value="Horror">Horror</option>
                                    <option value="Magic">Magic</option>
                                    <option value="Martial Arts">Martial Arts</option>
                                    <option value="Mecha">Mecha</option>
                                    <option value="Mystery">Mystery</option>
                                    <option value="Parody">Parody</option>
                                    <option value="Psychological">Psychological</option>
                                    <option value="Romance">Romance</option>
                                    <option value="Shoujo">Shoujo</option>
                                    <option value="Shounen">Shounen</option>
                                    <option value="School Life">School Life</option>
                                    <option value="Slife of Life">Slife of Life</option>
                                    <option value="Space">Space</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Super Power">Super Power</option>
                                    <option value="Supernatural">Supernatural</option>
                                    <option value="Tragedy">Tragedy</option>
                                    <option value="Thriller">Thriller</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quotes" class="col-sm-2 col-form-label">Multiverse?</label>
                            <div class="col-sm-4 mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="multiverse" id="multiverse-yes"
                                        value="1">
                                    <label class="form-check-label" for="multiverse-yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="multiverse" id="multiverse-no"
                                        value="0">
                                    <label class="form-check-label" for="multiverse-no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="roleplay-multiverse" style="display:none;">
                        <div class="form-group row">
                            <div class="col-sm-3 mt-1">
                                <input type="text" class="form-control form-control-sm" id="multiverse-code"
                                    placeholder="Kode Multiverse">
                            </div>
                            <div class="col-sm-3 mt-1">
                                <input type="text" class="form-control form-control-sm" id="multiverse-ranking"
                                    placeholder="Ranking Multiverse" name="multiverse_ranking">
                            </div>
                            <div class="col-sm-3 mt-1">
                                <select class="form-control form-control-sm" name="condition" id="condition">
                                    <option value="" disabled selected>Kondisi Multiverse</option>
                                    <option value="1">Active</option>
                                    <option value="0">Nonactive</option>
                                    <option value="2">Expired</option>
                                </select>
                            </div>
                            <div class="col-sm-3 mt-1">
                                <input type="number" class="form-control form-control-sm" id="multiverse-year"
                                    placeholder="Tahun Multiverse" name="multiverse_year">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mt-1">
                                <textarea rows="2" class="form-control form-control-sm" id="characteristic" placeholder="Karakteristik Multiverse"
                                    name="characteristic"></textarea>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <textarea rows="2" class="form-control form-control-sm" id="worlds" placeholder="Dunia di Multiverse"
                                    name="worlds"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="roleplay_id" id="roleplay-id">
                    <input type="hidden" name="operation" id="roleplay-operation">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="action-button" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal View -->
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="detailData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn hor-grd btn-grd-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Score View -->
<div id="score-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="score-form" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="score-aov">Your Score</label>
                        <input type="text" class="form-control form-control-sm" id="score-aov" placeholder="Berapa rating-nya?"
                            name="score">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="roleplay_id" id="roleplay-score-id">
                    <button type="button" class="btn hor-grd btn-grd-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn hor-grd btn-grd-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



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
                        <div class="col-sm-12 mt-1">
                            <select class="form-control form-control-sm" name="author" id="author">
                                <option value="" disabled selected>Author</option>
                                <?php require_once('../../../content/author.php'); ?>
                                <?php foreach($resultAuthor as $data): ?>
                                <option value="<?=$data->users_id ?>">
                                    <?=$data->username?>
                                </option>
                                <?php endforeach ?>
                            </select>
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
                                <?php require_once('../../../content/race.php'); ?>
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
                                <option value="1" disabled selected>Partner</option>
                                <option value="0">—</option>
                                <?php require_once('../../../content/character.php'); ?>
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


<!-- Character Score View -->
<div id="character-score-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="character-score-form" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="score-aov">Kontributor</label>
                        <input type="text" class="form-control form-control-sm" id="contributor" placeholder="Berapa rating-nya?"
                            name="contributor">
                    </div>
                    <div class="form-group">
                        <label for="score-aov">Attraction </label>
                        <input type="text" class="form-control form-control-sm" id="attraction" placeholder="Berapa rating-nya?"
                            name="attraction">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="character_id" id="character-score-id">
                    <button type="button" class="btn hor-grd btn-grd-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn hor-grd btn-grd-primary">Save</button>
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
                                <?php require_once('../../../content/roleplay.php'); ?>
                                <?php foreach($resultRoleplay as $data): ?>
                                <option value="<?=$data->roleplay_id ?>">
                                    <?=$data->roleplay_name?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control form-control-sm" name="role" id="role" required>
                                <option value="Guest" selected disabled>Role</option>
                                <option value="Main">Main</option>
                                <option value="Supporting">Supporting</option>
                                <option value="Guest">Guest</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="character_id" id="list-character-id">
                    <button type="submit" class="btn hor-grd btn-primary">Tambah</button>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn hor-grd btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Affiliation -->
<div id="affModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="affForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12 mt-1">
                            <input type="text" class="form-control form-control-sm" id="affiliation-name" placeholder="Nama Afiliasi, Tim, Organisasi, Geng, dan sebagainya"
                                name="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea rows="4" class="form-control form-control-sm" id="description" placeholder="Deskripsi dari Afiliasi-nya"
                                name="description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="id" id="affiliation-id">
                    <input type="hidden" name="operation" id="affiliation-operation">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="action-button-affiliation" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah Member pada Afiliasi -->
<div id="member-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Member</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="leader-table"></div>
            <div id="member-table"></div>
            <form id="member-form" method="POST">
                <div class="modal-body">
                    <div class="row mb-2">
                        <label class="col-sm-12 col-form-label"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Member pada Afiliasi</label>
                    </div>
                    <div class="form-group row mt-0">
                        <div class="col-sm-6 mb-2">
                            <select class="form-control form-control-sm" name="member" id="member-name"
                                required>
                                <option value="" selected disabled>Nama Member</option>
                                <?php require_once('../../../content/character.php'); ?>
                                <?php foreach($resultChara as $data): ?>
                                <option value="<?=$data->character_id ?>">
                                    <?=$data->character_fullname?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control form-control-sm" name="position" id="position" required>
                                <option value="" selected disabled>Position</option>
                                <option value="Leader">Leader</option>
                                <option value="Vice Leader">Vice Leader</option>
                                <option value="Member">Member</option>
                                <option value="Other">Other</option>
                                <option value="Ex-member">Ex-member</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="affiliation" id="list-affiliation-id">
                    <button type="submit" class="btn hor-grd btn-primary">Tambah</button>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn hor-grd btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add News -->
<div id="newsModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newsForm">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-12 mt-1">
                            <select class="form-control form-control-sm" name="author" id="author-news" required>
                                <option value="" disabled selected>Nama Penulis</option>
                                <?php require_once('../../../content/author.php'); ?>
                                <?php foreach($resultAuthor as $data): ?>
                                <option value="<?=$data->users_id ?>">
                                    <?=$data->username?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 mt-1">
                            <select class="form-control form-control-sm" name="category" id="category" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <?php require_once('../../../content/category.php'); ?>
                                <?php foreach($resultCategory as $datas): ?>
                                <option value="<?=$datas->category_id ?>">
                                    <?=$datas->category_name?>
                                </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Judul Artikel</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="title" placeholder="Judul Artikel"
                                name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photos" class="col-sm-2 col-form-label">Photos</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photos" name="photos" accept="image/x-png,image/gif,image/jpeg">
                                <label class="custom-file-label" for="photos">Pilih Foto untuk Artikel</label>
                            </div>
                            <div id="photos-news"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea rows="4" class="form-control form-control-sm" id="contents" placeholder="Konten"
                                name="contents"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <input type="hidden" name="id" id="news-id">
                    <input type="hidden" name="operation" id="news-operation">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" id="action-button-news" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>