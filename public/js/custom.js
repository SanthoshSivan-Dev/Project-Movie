$("#search").click(function(){
    if($('#searchDiv').hasClass('displayNone')){
        $('#searchDiv').removeClass('displayNone');
    }else{
        $('#searchDiv').addClass('displayNone');
    }
});

$("#closeBtn").click(function(){
    $('#msg-content').addClass('displayNone');
});

function searchMovie(){
    var apiKey = "f24a539babd487e39a5a13dd02dc4e24";
    var movieName = $('#movie_name').val();

    if (movieName.trim() === "") {
        $("#movienameError").text("Movie name is required.");
        return false
    }

    fetch('https://api.themoviedb.org/3/search/movie?query=' + encodeURIComponent(movieName) + '&api_key='+apiKey)
    .then(response => response.json())
    .then(data => {
        if(data.results.length > 0){
            $('#movie_id').val(data.results[0].id)
            $('#movie_name').val(data.results[0].title)
            $('#description').val(data.results[0].overview)
        }else{
            alert('No Record Found')
        }
    })
}

$(document).ready(function() {
    $('#formSubmit').submit(function(e) {
        e.preventDefault();
        $(".error").text("");

        var movie_id = $('#movie_id').val();
        var movie_name = $('#movie_name').val();

        if (movie_id.trim() === "") {
            $("#movieidError").text("Movie ID is required.");
            return false
        }

        if (movie_name.trim() === "") {
            $("#movienameError").text("Movie name is required.");
            return false
        }

        $.ajax({
            url: '/save',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                console.log(response);
                window.location.href = "/dashboard";
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});