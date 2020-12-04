import axios from 'axios'

export const state = () => ({
  interview: {},
  interviews: [],
  employerInterviews: [],
  questions: []
})

export const getters = {
  interview: state => state.interview,
  interviews: state => state.interviews,
  employerInterviews: state => state.employerInterviews,
  questions: state => state.questions
}

export const mutations = {
  SET_INTERVIEW (state, interview) {
    state.interview = interview
  },
  SET_INTERVIEWS (state, interviews) {
    state.interviews = interviews
  },
  SET_EMPLOYER_INTERVIEWS (state, employerInterviews) {
    state.employerInterviews = employerInterviews
  },
  SET_QUESTIONS (state, questions) {
    state.questions = questions
  }
}

export const actions = {

  fetchInterviews ({ commit }, { userId }) {
    return new Promise((resolve, reject) => {
      axios.get(`user/${userId}/interviews`)
        .then((response) => {
          commit('SET_INTERVIEWS', response.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  fetchEmployerInterviews ({ commit }, { userId }) {
    return new Promise((resolve, reject) => {
      axios.get(`employer/${userId}/interviews`)
        .then((response) => {
          commit('SET_EMPLOYER_INTERVIEWS', response.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  fetchInterview ({ commit }, { id }) {
    return new Promise((resolve, reject) => {
      axios.get(`interview/${id}/questions`)
        .then((response) => {
          commit('SET_INTERVIEW', response.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  fetchQuestions ({ commit }, id) {
    return new Promise((resolve, reject) => {
      axios.get(`/interview/questions/` + id)
        .then((response) => {
          commit('SET_QUESTIONS', response.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  create ({ commit, dispatch }, { item }) {
    return new Promise((resolve, reject) => {
      axios.post('/interview/create', { item })
        .then((response) => {
          if (response.data.id) {
            dispatch('fetchInterviews', { userId: item.invite_id })
            resolve(response)
          }
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
  edit ({ commit, dispatch }, { item }) {
    return new Promise((resolve, reject) => {
      axios.post('/interview/update', { item })
        .then((response) => {
          if (response.data.id) {
            dispatch('fetchInterviews')
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
      axios.post('/interview/delete/' + data.id)
        .then((response) => {
          dispatch('fetchInterviews')
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  }
}
