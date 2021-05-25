require('./bootstrap');

//import styles
import "gridjs/dist/theme/mermaid.css";
import "vue-toastification/dist/index.css";


// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import moment from 'moment';
import Toast, {POSITION}  from "vue-toastification";
import CKEditor from '@ckeditor/ckeditor5-vue';
moment.locale('es');


const el = document.getElementById('app');

const _app = createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})

_app.config.globalProperties.$moment=moment;
_app.use(Toast,{
    position : POSITION.BOTTOM_LEFT,
    transition: "fade"
});
_app.use(CKEditor)


_app.mixin({ methods: { route } })
.use(InertiaPlugin)
.mount(el);

InertiaProgress.init({ color: '#4B5563' });
