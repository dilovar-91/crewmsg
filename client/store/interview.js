import axios from 'axios'
import { data } from 'jquery'

// state
export const state = () => ({
  interview: {},
  interviews: [],
  questions: [],
})

// getters
export const getters = {
  interview: state => state.interview,
  interviews: state => state.interviews,
  questions: state => state.questions,
}

// mutations
export const mutations = {
  SET_INTERVIEW(state, interview) {
    state.interview = intervie
  },
  SET_INTERVIEWS(state, interviews) {
    state.interviews = intervies
  },
  SET_QUESTIONS(state, questions) {
    state.questions = questions
  }
}

// actions
export const actions = {

  fetchInterview({ commit }, id) {
    return new Promise((resolve, reject) => {
      axios.get("/interview/questions/" + id)
        .then((response) => {
          commit('SET_INTERVIEW', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  fetchQuestions({ commit }, id) {
    return new Promise((resolve, reject) => {
      axios.get("/interview/questions/" + id)
        .then((response) => {
          commit('SET_QUESTIONS', response.data)
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  async filterByMark({ commit, state, dispatch }, markId) {
    if (markId === undefined) {
      commit('SET_FILTERED', state.cars)
      return
    }
    if (!state.cars.length) {
      console.log("Empty Data")
    } else {
      const result = state.cars.filter(l => l.mark_id === markId)
      if (result) {
        commit('SET_FILTERED', result)
      } else {
        commit('SET_FILTERED', state.cars)
      }
    }
  },
  add({ commit, dispatch }, data) {
    return new Promise((resolve, reject) => {
      axios.post("/usedcar/add", { item: data.item })
        .then((response) => {
          if (response.data.id) {
            //commit('ADD_PRICE', Object.assign(data.item, { id: response.data.id }))
            dispatch('fetchCars');
            resolve(response)
          }
        })
        .catch((error) => { reject(error) })
    })
  },
  edit({ commit, dispatch }, data) {
    return new Promise((resolve, reject) => {
      axios.post("/usedcar/update", { item: data.item })
        .then((response) => {
          if (response.data.id) {
            //commit('ADD_PRICE', Object.assign(data.item, { id: response.data.id }))
            dispatch('fetchCars');
            resolve(response)
          }
        })
        .catch((error) => { reject(error) })
    })
  },
  delete({ commit, dispatch }, data) {
    return new Promise((resolve, reject) => {
      axios.post("/usedcar/delete/" + data.id)
        .then((response) => {
          dispatch('fetchCars');
          resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
}
