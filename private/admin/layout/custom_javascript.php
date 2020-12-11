<script type="text/javascript" src="../assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../assets/js/modernizr/modernizr.js"></script>
<script type="text/javascript" src="../assets/pages/widget/amchart/amcharts.min.js"></script>
<script type="text/javascript" src="../assets/pages/widget/amchart/serial.min.js"></script>
<script type="text/javascript" src="../assets/js/chart.js/Chart.js"></script>
<script type="text/javascript" src="../assets/pages/todo/todo.js "></script>
<script type="text/javascript" src="../assets/js/script.js"></script>
<script type="text/javascript" src="../assets/js/SmoothScroll.js"></script>
<script type="text/javascript" src="../assets/js/pcoded.min.js"></script>
<script type="text/javascript" src="../assets/js/vartical-demo.js"></script>
<script type="text/javascript" src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
<script type="text/javascript" src="../assets/js/sweetalert2.all.min.js"></script>
<script> 

        let pathname = window.location.pathname;
        if(pathname=='/private/admin/list_all_users/'){
            $('#users').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        }
        else if(pathname=='/private/admin/characters/'){
            $('#character').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        }
        else if(pathname=='/private/admin/news/'){
            $('#news').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        }
        else if(pathname=='/private/admin/messages/'){
            $('#messages').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        }
        else if(pathname=='/private/admin/roleplays/'){
            $('#roleplay').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        }
        else if(pathname=='/private/admin/awards/'){
            $('#award').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        } 
        else if(pathname=='/private/admin/team/'){
            $('#team').addClass('active-navbar');
            $('#home').removeClass('active-navbar');
        } else {
            $('#home').addClass('active-navbar');
        }
    </script>