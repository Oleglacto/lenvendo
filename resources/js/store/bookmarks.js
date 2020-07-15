import axios from 'axios';

export default {
    state: {
        pref: '/api/bookmarks',
        GET: {

        },
        POST: {
            makeBookmark: '/'
        },
        DELETE: {

        },
        PATCH: {

        },
        PUT: {

        },
    },
    getters: {

    },
    mutations: {

    },
    actions: {
        makeBookmark(context, url) {
            let formData = {
                'url': 'https://' + url
            };
            return axios.post(context.state.pref + context.state.POST.makeBookmark, formData)
        },
    }
}
