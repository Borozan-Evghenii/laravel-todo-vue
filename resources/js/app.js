import './bootstrap';
import { createApp } from 'vue';
import HeroScreen from './components/HeroScreen.vue'

const app = createApp({});

app.component('HeroScreen', HeroScreen);

app.mount("#app");
