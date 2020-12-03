import axios from 'axios'

// state
export const state = () => ({
  vacancy: {},
  vacancies: []
})

// getters
export const getters = {
  vacancy: state => state.vacancy,
  vacancies: state => state.vacancies
}

// mutations
export const mutations = {
  SET_VACANCY (state, vacancy) {
    state.vacancy = vacancy
  },
  SET_VACANCIES (state, vacancies) {
    state.vacancies = vacancies
  }
}

// actions
export const actions = {
  fetchUserVacancies ({ commit, state }, { userId }) {
    return new Promise((resolve, reject) => {
      axios.get(`/user/${userId}/vacancies`)
        .then((response) => {
          commit('SET_VACANCIES', response.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  create ({ commit }, { item }) {
    return new Promise((resolve, reject) => {
      axios.post(`vacancy/create`, { item })
        .then((response) => {
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  fetchVacancy ({ commit }, { id }) {
    return new Promise((resolve, reject) => {
      axios.get(`vacancy/${id}`)
        .then((response) => {
          commit('SET_VACANCY', response.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  edit ({ commit, dispatch }, { item }) {
    return new Promise((resolve, reject) => {
      axios.post('/vacancy/update', { item })
        .then((response) => {
          if (response.data.id) {
            dispatch('fetchVacancies')
            resolve(response)
          }
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  delete ({ commit, dispatch }, data) {
    return new Promise((resolve, reject) => {
      axios.post('/vacancy/delete/' + data.id)
        .then((response) => {
          dispatch('fetchVacancies')
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  }
}
