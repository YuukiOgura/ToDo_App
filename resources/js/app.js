import './bootstrap';
/* import './calendar'; importするとブラウザでエラー、Alpineを読み込まなくなるため、一時断念*/
import 'preline'
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();
