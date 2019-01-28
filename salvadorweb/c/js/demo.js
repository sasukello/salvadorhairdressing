/*jslint  browser: true, white: true, plusplus: true */
/*global $, countries */

$(function () {
    'use strict';

    
    var countriesArray = $.map(countries, function (value, key) { return { value: value, data: key }; });

    // Setup jQuery ajax mock:
    /*$.mockjax({
        url: '*',
        responseTime: 2000,
        response: function (settings) {
            var query = settings.data.query,
                queryLowerCase = query.toLowerCase(),
                re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi'),
                suggestions = $.grep(countriesArray, function (country) {
                     // return country.value.toLowerCase().indexOf(queryLowerCase) === 0;
                    return re.test(country.value);
                }),
                response = {
                    query: query,
                    suggestions: suggestions
                };

            this.responseText = JSON.stringify(response);
        }
    });*/

    // Initialize ajax autocomplete:
    $('#autocomplete-ajax').autocomplete({
        // serviceUrl: '/autosuggest/service/url',
        lookup: countriesArray,
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
            $('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
        },
        onHint: function (hint) {
            $('#autocomplete-ajax-x').val(hint);
        },
        onInvalidateSelection: function() {
            $('#selction-ajax').html('You selected: none');
        }
    });

    //var nhlTeams = ['S10;Anaheim Ducks', 'Atlanta Thrashers', 'Boston Bruins', 'Buffalo Sabres', 'Calgary Flames', 'Carolina Hurricanes', 'Chicago Blackhawks', 'Colorado Avalanche', 'Columbus Blue Jackets', 'Dallas Stars', 'Detroit Red Wings', 'Edmonton OIlers', 'Florida Panthers', 'Los Angeles Kings', 'Minnesota Wild', 'Montreal Canadiens', 'Nashville Predators', 'New Jersey Devils', 'New Rork Islanders', 'New York Rangers', 'Ottawa Senators', 'Philadelphia Flyers', 'Phoenix Coyotes', 'Pittsburgh Penguins', 'Saint Louis Blues', 'San Jose Sharks', 'Tampa Bay Lightning', 'Toronto Maple Leafs', 'Vancouver Canucks', 'Washington Capitals'];
    //var nbaTeams = ['S03;Atlanta Hawks', 'Boston Celtics', 'Charlotte Bobcats', 'Chicago Bulls', 'Cleveland Cavaliers', 'Dallas Mavericks', 'Denver Nuggets', 'Detroit Pistons', 'Golden State Warriors', 'Houston Rockets', 'Indiana Pacers', 'LA Clippers', 'LA Lakers', 'Memphis Grizzlies', 'Miami Heat', 'Milwaukee Bucks', 'Minnesota Timberwolves', 'New Jersey Nets', 'New Orleans Hornets', 'New York Knicks', 'Oklahoma City Thunder', 'Orlando Magic', 'Philadelphia Sixers', 'Phoenix Suns', 'Portland Trail Blazers', 'Sacramento Kings', 'San Antonio Spurs', 'Toronto Raptors', 'Utah Jazz', 'Washington Wizards'];
    var ve = $.map(venezuela, function (value, key) { return { value: value, data: { key2: key, category: 'Venezuela' }}; });
    var pty = $.map(panama, function (value, key) { return { value: value, data: { key2: key, category: 'Panamá' } }; });
    var us = $.map(usa, function (value, key) { return { value: value, data: { key2: key, category: 'USA' } }; });
    var rd = $.map(repdom, function (value, key) { return { value: value, data: { key2: key, category: 'Rep. Dominicana' } }; });
    var ec = $.map(ecuador, function (value, key) { return { value: value, data: { key2: key, category: 'Ecuador' } }; });
    var crz = $.map(curazao, function (value, key) { return { value: value, data: { key2: key, category: 'Curazao' } }; });

    var regiones = ve.concat(pty).concat(us).concat(rd).concat(ec).concat(crz);

    // Initialize autocomplete with local lookup:
    $('#autocomplete').devbridgeAutocomplete({
        //lookup: teams,
        lookup: regiones,
        minChars: 1,
        onSelect: function (suggestion) {

            var idsalon = suggestion.data.key2;

            document.getElementsByName("salonbuscar")[0].value = idsalon;
            mostrarSalonDet(idsalon);
            //$('#selection').html('Seleccionaste: ' + suggestion.value + ', ' + suggestion.data.category);

        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'Disculpe, no hubo resultados',
        groupBy: 'category'
    });
    
    // Initialize autocomplete with custom appendTo:
   /* $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#suggestions-container'
    });

    // Initialize autocomplete with custom appendTo:
    $('#autocomplete-dynamic').autocomplete({
        lookup: countriesArray
    });*/
});

function mostrarSalonDet($idsalon){
    //$('#selection').html('Id de Salón: ' + $idsalon);
    $('#selection').html("<br><br><img src='/c/img/loading.gif' width='32px' height='32px'>");
        $.ajax({
            method : "POST",
            url: '/c/api.php',
            data:{action:'showSD', data: $idsalon, paso: '1'},
            success:function(html) {
                $('#selection').html(html);
            }
        });
    
}

function showRegionList($idregion){
    $('#ubi2').html("<img src='/c/img/loading.gif' width='32px' height='32px'><br><br>");
        $.ajax({
            method : "POST",
            url: '/c/api.php',
            data:{action:'showRL', data: $idregion, paso: '1'},
            success:function(html) {
                $('#ubi2').html(html);
            }
        });
}