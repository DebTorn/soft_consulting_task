import CrudHandler from "../crud"

document.addEventListener('DOMContentLoaded', () => {
    const crudHandler = new CrudHandler('logsTable', null, '/logs', 'log');
});