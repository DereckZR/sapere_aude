// utils/renderTableActions.js

export function renderTableActions(routes, id, rules = {}) {
    let actions = [];

    if (routes.updateUrl && rules.canEdit) {
        const updateUrl = routes.updateUrl.replace(':id', id);
        const btn = new ActionButton({
            action: ActionType.UPDATE,
            id: id,
            url: updateUrl,
            type: 'primary',
            label: 'Editar'
        });

        actions.push(btn.render());
    }

    if (routes.deleteUrl && rules.canDelete) {
        const deleteUrl = routes.deleteUrl.replace(':id', id);
        const btn = new ActionButton({
            action: ActionType.DELETE,
            id: id,
            url: deleteUrl,
            type: 'danger',
            label: 'Eliminar'
        });

        actions.push(btn.render());
    }

    if (routes.restoreUrl && rules.canRestore) {
        const restoreUrl = routes.restoreUrl.replace(':id', id);
        const btn = new ActionButton({
            action: ActionType.RESTORE,
            id: id,
            url: restoreUrl,
            type: 'info',
            label: 'Restaurar'
        });

        actions.push(btn.render());
    }

    return actions;
}

export const ActionType = Object.freeze({
    EDIT: 'edit',
    DELETE: 'delete',
    SHOW: 'show',
    RESTORE: 'restore'
});

class ActionButton {
    constructor({
        action,
        id,
        url,
        type = 'primary',
        label = 'Button',
    }) {
        this.action = action;
        this.id = id;
        this.url = url;
        this.type = type;
        this.label = label;
    }

    render() {
        const button = document.createElement('button');

        button.className = `btn btn-sm btn-${this.type} btn-${this.action}`;

        button.dataset.id = this.id;
        button.dataset.url = this.url;

        button.textContent = this.label;

        return button;
    }
}
