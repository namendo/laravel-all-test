import PrimeVue from 'primevue/config';
import ProgressBar from'primevue/progressbar';
import { createApp } from 'vue'
import App from './App.vue'
import './index.css'
import './style.css';
const app = createApp(App);
app.component("ProgressBar", ProgressBar);
app.use(PrimeVue, { theme: "none" });
app.mount('#app')
