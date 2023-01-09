$(document).ready(
    function() {
        $('a').click(function() {
            var ben = $(this).find($('h4')).text();

            var params = new URLSearchParams();
            params.append("first", ben);
            location.href = "http://localhost/cadsite/sub.php?" + params.toString()



        });



    })