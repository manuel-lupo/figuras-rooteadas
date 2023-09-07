const URI = window.location;
const AREAFORM = document.getElementById('areaForm');
const ADDFORM = document.getElementById('addForm');

if (AREAFORM) {
    AREAFORM.addEventListener('submit', function (e) {
        e.preventDefault();
        data = new FormData(AREAFORM);
        let url = `menor-a/${data.get('area')}`;
        // realizo el llamado
        window.location.href = url;
    })

}
if (ADDFORM) {
    ADDFORM.addEventListener('submit', function (e) {
        e.preventDefault();
        data = new FormData(ADDFORM);
        type = null;
        params = [];
        if (data.get('base') != null) {
            params.push(data.get('base'))
            type = 'triangle'
        }
        if (data.get('radius') != null) {
            params.push(data.get('radius') )
            type = 'circle'
        }
        if (data.get('side') != null) {
            params.push(data.get('side'));
            type = 'square'
        }
        if (data.get('height') != null)
            params.push(data.get('height'))
        let url = `add/${type}`;
        params.forEach(param => {
            url += `/${param}`;
        });
        window.location.href = url;
    });

    ADDFORM.addEventListener('change', function (e) {
        if (e.target.tagName === 'SELECT' && e.target.id === 'type') {
            showFigureData(e.target.value);
        }
    });

    function showFigureData(figureType) {
        let dataContainer = ADDFORM.querySelector('#figureSpecs');
        switch (figureType) {
            case 'triangle':
                dataContainer.innerHTML = `
                <label for='base'>Inserte la base del triangulo:</label>
                <input type='number' name='base' id='base'> 
                <label for='height'>Inserte la altura del triangulo:</label>
                <input type='number' name='height' id='altura'>
                `;
                break;

            case 'circle':
                dataContainer.innerHTML = `
                    <label for='radius'>Inserte el radio del circulo:</label>
                    <input type='number' name='radius' id='radius'>
                `;
                break;

            case 'square':
                dataContainer.innerHTML = `
                <label for='side'>Inserte el tamaño de los lados:</label>
                <input type='number' name='side' id='side'>
            `;
                break;


            default:
                break;
        }
        let boton = ADDFORM.querySelector('#enviar');
        if (boton == null)
            ADDFORM.innerHTML += `<button type ='submit' id='enviar'>Agregar figura</button>`;
    }
}
