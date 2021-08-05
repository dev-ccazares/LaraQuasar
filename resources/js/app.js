require('./bootstrap');
import { createApp } from 'vue';
import CouponsMain from './components/CouponsMain';
const app = createApp({});
app.component('CouponsMain', CouponsMain);
app.use(Quasar)
Quasar.lang.set(Quasar.lang.es)
Quasar.iconSet.set(Quasar.iconSet.fontawesomeV5)
app.mount('#app');
