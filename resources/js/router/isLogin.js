export default function auth ({ next }){
    const store = JSON.parse(window.localStorage.getItem('vuex'));
    const access_token = store.access_token;
    if(!access_token){
        return next({
            name: 'login.index'
        })
    }
    return next()
}
