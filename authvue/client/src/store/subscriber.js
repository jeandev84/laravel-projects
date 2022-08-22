import store from "@/store/index";
import axios from "axios";



store.subscribe((mutation) => {
    // console.log(mutation);

    switch (mutation.type) {
        case 'auth/SET_TOKEN':
            // console.log(mutation.payload);

            if (mutation.payload) {
                // Set headers
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`;

                // Set Information in to the LocalStorage
                localStorage.setItem('token', mutation.payload);

            } else {

                // unset information
                axios.defaults.headers.common['Authorization'] = null;
                localStorage.removeItem('token');
            }

        break;
    }
})

/*
let response = await axios.get('auth/me', {
             headers: {
                 'Authorization': 'Bearer ' + token
             }
});
 */