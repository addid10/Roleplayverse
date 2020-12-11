                  
               <div class="navbar-wrapper">
                   <div class="navbar-logo">
                       <a class="mobile-menu" id="mobile-collapse" href="#!">
                           <i class="ti-menu"></i>
                       </a>
                       <a href="../home">
                           <img class="img-fluid" src="../../../assets/img/logo.png" alt="Theme-Logo" />
                       </a>
                       <a class="mobile-options">
                           <i class="ti-more"></i>
                       </a>
                   </div>

                   <div class="navbar-container container-fluid">
                       <ul class="nav-left">
                           <li>
                               <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                           </li>
                           <li>
                               <a href="#!" onclick="javascript:toggleFullScreen()">
                                   <i class="ti-fullscreen"></i>
                               </a>
                           </li>
                       </ul>
                       <ul class="nav-right">
                           <li class="user-profile header-notification">
                               <a href="#!">
                                   <img src="../../../assets/img/aov-profile.png" class="img-radius">
                                   <span><?= $_SESSION['usernameAdmin']; ?></span>
                                   <i class="fa fa-caret-down" aria-hidden="true"></i>
                               </a>
                               <ul class="show-notification profile-notification">
                                   <li>
                                        <a href="../users/logout">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                   </li>
                               </ul>
                           </li>
                       </ul>
                   </div>
               </div>