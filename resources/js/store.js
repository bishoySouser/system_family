import {getLoggedinUser} from './helpers/auth';
const user = getLoggedinUser();
export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        expireToken: 5,
        loading: false,
        auth_error: null,
        reg_error:null,
        registeredUser: null,
    },
    getters: {
        isLoading(state){
            return state.loading;
        },
        isLoggedin(state){
            return state.isLoggedIn;
        },
        currentUser(state){
            return state.currentUser;
        },
        tokenExpire(state){
            return state.expireToken;
        },
        authError(state){
            return state.auth_error;
        },
        regError(state){
            return state.reg_error;
        },
        registeredUser(state){
            return state.registeredUser;
        },
    },
    mutations: {
        login(state){
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload){
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.currentUser = Object.assign({}, payload.user);
            localStorage.setItem("user", JSON.stringify(state.currentUser));
            localStorage.setItem("token", payload.access_token);
        },
        loginFailed(state, payload){
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state){
            localStorage.removeItem("user");
            localStorage.removeItem("token");
            state.isLoggedIn = false;
            state.currentUser = null;
        },
        registerSuccess(state, payload){
            state.reg_error = null;
            state.registeredUser = payload.user;
        },
        registerFailed(state, payload){
            state.reg_error = payload.error;
        },
    },
    actions: {
            login(context){
                context.commit("login");
            }
        }
};