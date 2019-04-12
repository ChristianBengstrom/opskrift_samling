jQuery(document).ready(function($) {
    // Set the Options for "Bloodhound" suggestion engine
    var engine = new Bloodhound({
        remote: {
            url: '/autocomplete?q=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    $("#search").typeahead({
        hint: true,
        highlight: true,
        minLength: 1,
    }, {
        source: engine.ttAdapter(),

        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'ingrList',

        // the key from the array we want to display (name,id,email,etc...)
        templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
            ],
            // header: [
            //     '<div class="list-group search-results-dropdown">'
            // ],
            suggestion: function (data) {
                return '<p class="list-group-item">' + data.navn + '</p>'; //list-group-item tt-suggestion tt-selectable
            }
        },
    });
});
