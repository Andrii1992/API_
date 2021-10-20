export const state = () => ({
    users: {}
})
export const mutations = {
    setUsers(state, users) {
        state.users = users
    }
}
export const actions = {
    async fetch({ commit }, data) {
        await this.$axios.$get("admin/uzytkowniki?search=" + data.ser + "&page=" + data.page + "&sort=" + data.sort + "&by=" + data.by + "&records=" + data.records).then(response => {
            commit('setUsers', response.data);
        }).catch((error) => {
            console.log(error);
        });
    }
}

export const getters = {
    users: s => s.users
}