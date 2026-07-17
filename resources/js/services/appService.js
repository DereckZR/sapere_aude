import { initFormModal } from './modalService.js';
import { initRemoveInvalidFeedback } from '../utils/removeInvalidFeedback.js';
import { initComponents } from '../components/initComponents.js';

export function initApp() {
    initFormModal();
    initRemoveInvalidFeedback();
    initComponents();
}

