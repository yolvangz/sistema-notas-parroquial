{{-- No surplus words or unnecessary actions. - Marcus Aurelius --}}
@php
    $literales = $literales ?? [];
@endphp

<div>
    <div class="literales-input">
        <div class="form-group">
            <button type="button" id="add-literal" class="btn btn-primary btn-sm mt-2">Añadir literal</button>
            <ul id="literales-list" class="list-group mt-2">
                <!-- Dynamic list items will be rendered here -->
            </ul>
        </div>
        <input type="hidden" name="calificacionCualitativaLiterales" id="literales-input" value="[]">
    </div>
</div>
    
@pushOnce('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const referencias = {{ Js::from($referencias) }};
            const selectsFromReferencias = Object.keys(referencias).map(referencia => document.getElementById(referencia));
            const literalesInicial = {{ Js::from($literales) }};
            console.log(literalesInicial);
            const list = document.getElementById('literales-list');
            const input = document.getElementById('literales-input');
            const addButton = document.getElementById('add-literal');
    
            // Update the hidden input with the current list of literales
            function updateInput() {
                const nuevosliterales = Array.from(list.querySelectorAll('li.list-group-item')).map(item => {
                    return {
                        letra: item.querySelector('.literal-value-letter').value,
                        descripcion: item.querySelector('.literal-value-description').value,
                    }
                });
                input.value = JSON.stringify(nuevosliterales);
                updateReferencias(nuevosliterales);
            }
            function updateReferencias(literales) {
                for (const select of selectsFromReferencias) {
                    // Save the currently selected value
                    const selectedValue = select.value;

                    // Update the options
                    select.innerHTML = literales.reduce((content, literal, ) => 
                        content + `<option value="${literal.letra}">${literal.letra}${literal.descripcion ? ' (' + literal.descripcion + ')' : ''}</option>`, 
                    '');

                    // Reassign the selected value if it still exists
                    if (literales.some(literal => literal.letra === selectedValue)) {
                        select.value = selectedValue;
                    } else {
                        // If the previous value doesn't exist, no option will be selected
                        select.value = '';
                    }
                }
            }

            // Add a new letter to the list
            addButton.addEventListener('click', () => addNewListItem());

            function addNewListItem(letra = '', descripcion = '') {
                const emptyListItem = list.querySelector('.list-group-item.empty') ?? null;
                if (emptyListItem) list.removeChild(emptyListItem);
                
                const listItem = insertListItem(letra, descripcion);
                list.appendChild(listItem);
                updateInput();
            }

            function insertListItem(letra, descripcion) {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                listItem.innerHTML = `
                    <input type="text" class="form-control form-control-sm literal-value-letter mr-2" value="${letra}" placeholder="Letra" style="flex-basis:20%">
                    <input type="text" class="form-control form-control-sm literal-value-description mr-2" value="${descripcion ?? ''}" placeholder="Descripcion" style="flex-grow:1">
                    <div class="d-inline-flex">
                        <button type="button" class="mr-1 btn btn-success btn-sm move-up"><span style="font-size: 0.75rem; vertical-align: middle;"><i class="fas fa-arrow-up"></i></span></button>
                        <button type="button" class="mr-1 btn btn-warning btn-sm move-down"><span style="font-size: 0.75rem; vertical-align: middle;"><i class="fas fa-arrow-down"></i></span></button>
                        <button type="button" class="mr-1 btn btn-danger btn-sm remove-literal"><span style="font-size: 0.75rem; vertical-align: middle;"><i class="fas fa-times"></i></span></button>
                    </div>
                `;

                return listItem;
            }  
            // Handle list actions (edit, remove, reorder)
            list.addEventListener('click', function (e) {
                const emptyListItem = list.querySelector('.list-group-item.empty') ?? null;
                const target = e.target.closest('button');
                const listItem = target?.closest('li');
                let action = false;

                if (!target || !listItem) return; // Exit if no button or list item is found
    
                if (target.classList.contains('remove-literal')) {
                    action = true;
                    listItem.remove();
                    if (list.childElementCount === 0) {
                        const empty = document.createElement('div');
                        empty.className = 'list-group-item empty';
                        empty.innerHTML = '<br>';
                        list.appendChild(empty);
                    }
                } else if (target.classList.contains('move-up')) {
                    action = true;
                    const prev = listItem.previousElementSibling;
                    if (prev) list.insertBefore(listItem, prev);
                } else if (target.classList.contains('move-down')) {
                    action = true;
                    const next = listItem.nextElementSibling;
                    if (next) list.insertBefore(next, listItem);
                }
    
                if (action) updateInput();
            });

            // Update input on letter change
            list.addEventListener('input', function () {
                updateInput();
            });

            // Inicializa
            if (literalesInicial.length === 0) {
                const empty = document.createElement('div');
                empty.className = 'list-group-item empty';
                empty.innerHTML = '<br>';
                list.appendChild(empty);
            } else {
                for (const literal of literalesInicial) {
                    addNewListItem(literal.letra, literal.descripcion);
                }
            }
            for (const select of selectsFromReferencias) {
                select.value = referencias[select.id];
            }
        });
    </script>
@endPushOnce