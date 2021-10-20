export const state = () => ({
    user: {}
})
export const mutations = {
    setuser(state, user) {
        state.user = user
    }
}
export const actions = {
    async fetchEditShow({ commit }, id) {
        await this.$axios.$get('admin/uzytkowniki/edycja/' + id).then(response => {
            commit('setuser', response.user);
        }).catch((error) => {
            console.log(error);
        });
    }
}

export const getters = {
    user: s => s.user
}