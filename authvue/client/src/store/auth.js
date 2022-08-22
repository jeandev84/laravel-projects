import axios from "axios";

export default {
    // Import the namespace for using inside views/ for example
    namespaced: true,
    // Store information from backend
    state: {
        token: null,
        user: null // user : {email: '', 'name': ''} from backend
    },
    // Extract from at state.
    getters: {
       // if we have token + user that it mean user authenticated.
       authenticated(state) {
           return state.token && state.user;
       },
       // Get user information
       user(state) {
           return state.user;
       }
    },
    // Assignment
    mutations: {

        SET_TOKEN(state, token) {
            state.token = token;
        },
        SET_USER(state, user) {
            state.user = user;
        }
    },
    actions: {

        // first param _ { dispatch || commit } a mutations
        // return axios
        async signIn({ dispatch }, credentials) {

            let response = await axios.post('/auth/signin', credentials)

            // console.log(response.data);

            return dispatch('attempt', response.data.token);
        },
        // first param _ { dispatch || commit } a mutations
        // state (current state)
        async attempt({ commit, state }, token) {

            // console.log(token);

            if (token) {
                commit('SET_TOKEN', token);
            }

            if (! state.token) {
                 return;
            }

            try {

                /*
                let response = await axios.get('auth/me', {
                     headers: {
                         'Authorization': 'Bearer ' + token
                     }
                });
                */

                let response = await axios.get('auth/me');

                commit('SET_USER', response.data);

            } catch (e) {

                // console.log('failed');
                commit('SET_TOKEN', null);
                commit('SET_USER', null);
            }
        }
    }
}
