export const state = () => ({
    posts: {}
})
export const mutations = {
    setPosts(state, posts) {
        state.posts = posts
    }
}
export const actions = {
    async fetch({ commit }, data) {

        await this.$axios.$get("admin/posty?search="+data.ser+"&page="+ data.page+"&sort=" + data.sort+"&by="+data.by+"&records="+data.records).then(response => {
            commit('setPosts', response.posts);
        }).catch((error) => {
            console.log(error);
        });
    }
}

export const getters = {
    posts: s => s.posts
}