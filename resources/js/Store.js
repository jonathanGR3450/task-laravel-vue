import { createStore } from 'vuex'
import Auth from './Auth.js';

const store = createStore({
    state: {
        isAuthenticated: Auth.check(),
    },
    mutations: {
        setAuthenticated(state, isAuthenticated) {
            state.isAuthenticated = isAuthenticated;
        },
    },
});

export default store;