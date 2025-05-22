<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
    <div class="literales-input">
        <div class="form-group">
            <button type="button" id="add-literal" class="btn btn-primary btn-sm mt-2">Añadir literal</button>
            <ul id="literales-list" class="list-group mt-2">
                <!-- Dynamic list items will be rendered here -->
                <div class="list-group-item empty"><br></div>
            </ul>
        </div>
        <input type="hidden" name="literales" id="literales-input" value="[]">
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const referencias = {{ Js::from($referencias) }};
            const list = document.getElementById('literales-list');
            const input = document.getElementById('literales-input');
            const addButton = document.getElementById('add-literal');
    
            // Update the hidden input with the current list of literales
            function updateInput() {
                const literales = Array.from(list.querySelectorAll('li.list-group-item')).map(item => {
                    return {
                        letra: item.querySelector('.literal-value-letter').value,
                        descripcion: item.querySelector('.literal-value-description').value,
                    }
                });
                input.value = JSON.stringify(literales);
                updateReferencias(referencias, literales);
            }
            function updateReferencias (referencias, literales) {
                selectFromReferencias = referencias.map(referencia => document.getElementById(referencia));

                for (const select of selectFromReferencias) {
                    select.innerHTML = literales.reduce((content, literal) => content+`<option value="${literal.letra}">${literal.letra}${literal.descripcion ? ' ('+literal.descripcion+')' : ''}</option>`, '');
                }
            }
    
            // Add a new letter to the list
            addButton.addEventListener('click', function () {
                const emptyListItem = list.querySelector('.list-group-item.empty') ?? null;
                if (emptyListItem) list.removeChild(emptyListItem);
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
    
                listItem.innerHTML = `
                        <input type="text" class="form-control form-control-sm literal-value-letter mr-2" value="" placeholder="Letra" style="flex-basis:20%">
                        <input type="text" class="form-control form-control-sm literal-value-description mr-2" value="" placeholder="Descripcion" style="flex-grow:1">
                        <div class="d-inline-flex">
                            <button type="button" class="mr-1 btn btn-success btn-sm move-up">↑</button>
                            <button type="button" class="mr-1 btn btn-warning btn-sm move-down">↓</button>
                            <button type="button" class="mr-1 btn btn-danger btn-sm remove-literal">✖</button>
                        </div>
                `;
    
                list.appendChild(listItem);
                updateInput();
            });
    
            // Handle list actions (edit, remove, reorder)
            list.addEventListener('click', function (e) {
                const emptyListItem = list.querySelector('.list-group-item.empty') ?? null;
                const target = e.target;
                const listItem = target.closest('li');
                let action = false;
    
                if (target.classList.contains('remove-literal')) {
                    action = true;
                    listItem.remove();
                    if(list.childElementCount === 0) {
                        empty = document.createElement('div');
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
        });
    </script>
</div>