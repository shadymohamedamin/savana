//import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import Inputmask from "inputmask";

document.addEventListener("DOMContentLoaded", () => {
    Inputmask("784-9999-9999999-9").mask("input[name='uae_id']");
    Inputmask("059999999").mask("input[name='mobile']");
});
