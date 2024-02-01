import CrudHandler from "../crud"

document.addEventListener('DOMContentLoaded', () => {
    const crudHandler = new CrudHandler('personTable', 'personModal', '/persons', 'person');
});