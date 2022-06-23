import axios from "axios";
export default {
    state: {
        category: [],
        user: [],
        content: []
    },
    getters: {
        categoryList(state) {
            return state.category
        },
        userList(state) {
            return state.user
        },
        contentList(state) {
            return state.content
        }
    },
    actions: {
        categoryList(context) {
            axios.get('/categoryList').then((response) =>{
                context.commit('categoryList',response.data.categoryList)
            })
        },
        userList(context) {
            axios.get('/userList').then((response) =>{
                context.commit('userList',response.data.userList)
            })
        },
        contentList(context) {
            axios.get('/contentList').then((response) =>{
                context.commit('contentList',response.data.contentList)
            })
        }
    },
    mutations:{
        categoryList(state, response) {
            return state.category = response
        },
        userList(state, response) {
            return state.user = response
        },
        contentList(state, response) {
            return state.content = response
        },
    }
}
