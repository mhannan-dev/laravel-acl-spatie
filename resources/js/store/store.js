import axios from "axios";
export default{
    state:{
        category:[],
        user:[],
        content:[]
    },
    getters: {
        categoryList (state) {
          return state.category
        },
        userList (state) {
          return state.user
        },
        contentList (state) {
          return state.content
        }
      }
}
