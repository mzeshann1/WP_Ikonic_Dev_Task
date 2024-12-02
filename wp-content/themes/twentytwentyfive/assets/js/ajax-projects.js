jQuery(document).ready(function($) {
    jQuery('#projects-list').html('<div class="loader"></div>');
    jQuery.ajax({
        url: ajax_object.ajax_url,
        type: 'GET',
        data: {
            action: 'get_architecture_projects'
        },
        success: function(response) {
            if (response.success) {
                var projects = response.data;
                console.log(projects);
                var output = '<ul>';
                jQuery.each(projects, function(index, project) {
                    output += '<li><a href="' + project.link + '">' + project.title + '</a></li>';
                });
                output += '</ul>';
                jQuery('#projects-list').html(output);
            } else {
                jQuery('#projects-list').html('No projects found.');
            }
        },
        error: function() {
            jQuery('#projects-list').html('An error occurred while fetching the projects.');
        }
    });
});



jQuery(document).ready(function ($) {
    const quotesList = $('#kanye-quotes-list');
    const apiUrl = 'https://api.kanye.rest/';
    quotesList.html('<li>Loading...</li>');
    let quotesFetched = 0;
    const maxQuotes = 5;
    let quotes = [];
    function fetchQuote() {
        jQuery.ajax({
            url: apiUrl,
            type: 'GET',
            success: function (response) {
                quotes.push(response.quote);
                quotesFetched++;

                if (quotesFetched < maxQuotes) {
                    fetchQuote(); 
                } else {
                    renderQuotes(); 
                }
            },
            error: function () {
                quotesList.html('<li>Failed to load quotes. Please try again later.</li>');
            },
        });
    }
    function renderQuotes() {
        quotesList.html('');
        quotes.forEach((quote) => {
            quotesList.append('<li>"' + quote + '"</li>');
        });
    }

    fetchQuote();
});
