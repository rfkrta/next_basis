

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".span1").click(function() {
                $(".dropdown").slideToggle(500);
            });
        });

        $(document).ready(function() {
            $(".span2").click(function() {
                $(".dropdown1").slideToggle(500);
            });
        });

        $(document).ready(function() {
            $(".span3").click(function() {
                $(".dropdown2").slideToggle(500);
            });
        });

        $(document).ready(function() {
            $(".span4").click(function() {
                $(".dropdown3").slideToggle(500);
            });
        });

        $('.sidenav li').click(function() {
            $('.sidenav li').removeClass("active");
            $(this).addClass("active");
        });

        $('.filter div').click(function() {
            $('.filter div').removeClass("active2");
            $(this).addClass("active2");
        });

        $('.filterx li').click(function() {
            $('.filterx li').removeClass("activev");
            $(this).addClass("activev");
        });
    </script>

    <script type="text/javascript">
        $(".menu-icon").click(function(e) {
            e.preventDefault();
            $(".menu-icon").toggleClass("menuicon");
            $(".main").toggleClass("main-width");
            $(".sidebar").toggleClass("active1");
            $(".sidenav li a").toggleClass("anchor");
            $(".sidenav li").toggleClass("lislide");
            $(".sidenav p").toggleClass("apphide");
            $(".logo span").toggleClass("headspan");
            $(".logo").toggleClass("lm");
            $(".admin1 a").toggleClass("anchor");
            $(".admin1 h6").toggleClass("anchor");
            $(".admin2").toggleClass("lislide1");
            $(".main").toggleClass("lislide2");
            $(".cong-box").toggleClass("cong");
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".user").click(function() {
                $(".profile-div").toggle(1000);
            });
            $(".bell").click(function() {
                $(".notification-div").toggle(1000);
            });
        });
    </script>