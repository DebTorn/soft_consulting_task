import { Modal } from 'bootstrap';
import DataTable from 'datatables.net-bs5';

class CrudHandler {
    constructor(_tableId, _modalId, _baseUrl, _idPrefix, _tableIni = {}) {
        this.tableIni = _tableIni;
        this.tableId = _tableId;
        this.modalId = _modalId;
        this.baseUrl = _baseUrl;
        this.idPrefix = _idPrefix;
        this.iniTable();
        this.initEventHandlers();
    }

    iniTable() {
        this.tableIni.language = {
            lengthMenu: "Mutass _MENU_ sort",
            zeroRecords: "Nincs a keresésnek megfelelő találat",
            info: "Találatok: _START_ - _END_ / _TOTAL_",
            infoEmpty: "Nincs elérhető adat",
            infoFiltered: "(összesen _MAX_ bejegyzésből szűrve)",
            search: "Keresés:",
            paginate: {
            first:      "Első",
            previous:   "Előző",
            next:       "Következő",
            last:       "Utolsó"
            },
            aria: {
            sortAscending:  ": aktiválja a növekvő rendezéshez",
            sortDescending: ": aktiválja a csökkenő rendezéshez"
            }
        };

        this.dataTable = new DataTable('#' + this.tableId, this.tableIni);

        let rows = document.querySelectorAll('#' + this.tableId + '_wrapper .row');

        if (rows.length > 0) {
            let firstRowElement = rows[0];

            if (firstRowElement) {
                let searchInputField = firstRowElement.children[1];

                if (searchInputField) {
                    searchInputField.remove();
                }
            }
            // searchInpitField.remove();
        }

    }

    getDataTable() {
        return this.dataTable;
    }

    initEventHandlers() {
        const editButtons = document.getElementsByName(this.idPrefix + '-edit');
        const deleteButtons = document.getElementsByName(this.idPrefix + '-delete');

        editButtons.forEach(btn => {
            if (!btn.hasAttribute('data-event-attached')) {
                btn.addEventListener('click', this.editHandler.bind(this));
                btn.setAttribute('data-event-attached', 'true');
            }
        });

        deleteButtons.forEach(btn => {
            if (!btn.hasAttribute('data-event-attached')) {
                btn.addEventListener('click', this.deleteHandler.bind(this));
                btn.setAttribute('data-event-attached', 'true');
            }
        });
    }

    editHandler(e) {
        const id = e.target.dataset.id;

        if (id) {
            console.log(this.baseUrl);
            window.axios.get(`${this.baseUrl}/${id}`).then(response => {

                if (response.status === 200) {
                    const modalElement = document.getElementById(this.modalId);
                    const modal = new Modal(modalElement, {
                        keyboard: true
                    });

                    modalElement.addEventListener('show.bs.modal', () => {
                        this.fillEditForm(response.data);
                    });

                    modal.show();
                }
            });
        }
    }

    deleteHandler(e) {
        const id = e.target.dataset.id;

        if (id && confirm('Biztosan törölni szeretné az elemet?')) {
            const alertModalId = 'alertModal';
            const alertModal = new Modal('#' + alertModalId);
            const alertModalBody = document.querySelector('#' + alertModalId + ' .modal-body');
            if (alertModal && alertModalBody) {
                window.axios.delete(`${this.baseUrl}/${id}`).then((resp) => {
                    if (alertModalBody.classList.contains('bg-danger')) {
                        alertModalBody.classList.remove('bg-danger');
                    }

                    alertModalBody.classList.add('bg-success');
                    alertModalBody.classList.add('text-white');
                    alertModalBody.innerHTML = resp.data.message;
                    alertModal.show();

                    e.target.parentNode.parentNode.remove()

                }).catch((error) => {
                    if (alertModalBody.classList.contains('bg-success')) {
                        alertModalBody.classList.remove('bg-success');
                    }

                    alertModalBody.classList.add('bg-danger');
                    alertModalBody.classList.add('text-white');
                    if (error.response) {
                        alertModalBody.innerHTML = error.response.data.message;

                    } else {
                        alertModalBody.innerHTML = 'Egyéb hiba miatt a törlés nem végrehajtható';
                        console.log(error);
                    }

                    alertModal.show();
                });

            }

        }
    }

    fillEditForm(data) {
        for (let key in data) {
            if (data.hasOwnProperty(key)) {
                let inputField = document.getElementById(key);

                if (inputField) {
                    inputField.value = 0;
                    if (Array.isArray(data[key])) { //select or multiselect
                        let ids = data[key].map(item => item.id);
                        for (var i = 0; i < inputField.options.length; i++) {
                            var option = inputField.options[i];
                            if (ids.includes(parseInt(option.value))) {
                                option.selected = true;
                            }
                        }
                    } else { //input field
                        inputField.value = data[key];
                    }
                }
            }
        }
    }
}

export default CrudHandler;
