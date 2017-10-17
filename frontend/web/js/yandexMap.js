let searchControl,
    suggestView;

ymaps.ready(init);

function init(){
    suggestView = new ymaps.SuggestView('inputYandexMap');
    searchControl = new ymaps.control.SearchControl({
        options: {
            float: 'left',
            floatIndex: 100,
            noPlacemark: true
        }
    });
    $('#inputYandexMap').on('change', function () {
        let value = $(this).val();
        searchControl.search(value).then(function () {
            let geoOjectsArray = searchControl.getResultsArray();
            if(geoOjectsArray.length){
                $('#toYandexMap').val(value);
                console.log(geoOjectsArray[0].geometry.getCoordinates());
            }
        });
    });
}