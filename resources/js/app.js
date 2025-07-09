import './bootstrap';
/* import './calendar'; importするとブラウザでエラー、Alpineを読み込まなくなるため、一時断念*/
import 'preline'
import Alpine from 'alpinejs';

// Import click handlers
import * as ClickHandlers from './utils/clickHandlers';

// Make click handlers available globally
window.ClickHandlers = ClickHandlers;
window.Alpine = Alpine;

Alpine.start();

// DOM準備完了後にイベントリスナーを添付
document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('myButton');
    if (button) {
        // 重複を防ぐため、既存のリスナーを削除
        button.removeEventListener('click', ClickHandlers.handleMyButtonClick);
        // 新しいリスナーを添付
        button.addEventListener('click', ClickHandlers.handleMyButtonClick);
    }
});

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);
