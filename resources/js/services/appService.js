import { initFormModal } from './modalService.js';
import { initRemoveInvalidFeedback } from '../utils/removeInvalidFeedback.js';

export function initApp() {
    initFormModal();
    initRemoveInvalidFeedback();
}

