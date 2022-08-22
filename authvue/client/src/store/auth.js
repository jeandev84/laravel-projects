import axios from "axios";

export default {
    namespaced: true, // import the namespace for using inside views/ for example
    state: {
        token: null,
        user: null // user : {email: '', 'name': ''} from backend
    },
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
        async signIn({ dispatch }, credentials) {

            let response = await axios.post('/auth/signin', credentials)

            // console.log(response.data);

            dispatch('attempt', response.data.token);
        },
        // first param _ { dispatch || commit } a mutations
        async attempt({ commit }, token) {

            // console.log(token);

            commit('SET_TOKEN', token);

            try {

                let response = await axios.get('auth/me', {
                     headers: {
                         'Authorization': 'Bearer ' + token
                     }
                });

                commit('SET_USER', response.data);

            } catch (e) {
                 console.log('failed');
            }
        }
    }
}
