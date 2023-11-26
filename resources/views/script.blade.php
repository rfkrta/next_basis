

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<!-- Tambahkan di bagian bawah sebelum tag </body> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- <script type="text/javascript">
        $(document).ready(function() {
            $('table').DataTable({
                //"paging": false,
                //"ordering": false,
                //"info": false,
                "order": [],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive : true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
                }
            });
        } );
    </script> -->
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