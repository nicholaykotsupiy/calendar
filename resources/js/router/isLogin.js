export default function auth ({ next }){
    const store = JSON.parse(window.localStorage.getItem('vuex'));
    const user = store.user;
    const access_token = store.access_token;
    if(!user || !access_token){
        return next({
            name: 'login.index'
        })
    }
    return next()
}
