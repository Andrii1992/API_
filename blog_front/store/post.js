export const state = () => ({
    post: {}
})
export const mutations = {
    setPost(state, post) {
        state.post = post
    }
}
export const actions = {
    async fetchEditShow({ commit }, id) {
        await this.$axios.$get('admin/posty/edycja/' + id).then(response => {
            commit('setPost', response.post);
        }).catch((error) => {
            console.log(error);
        });
    }
}

export const getters = {
    post: s => s.post
}