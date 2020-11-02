import Vue from 'vue'
import Router from 'vue-router'
import { scrollBehavior } from '~/utils'

Vue.use(Router)

const page = path => () => import(`~/pages/${path}`).then(m => m.default || m)

const routes = [
  { path: '/', name: 'home', component: page('home.vue') },
  { path: '/about', name: 'about', component: page('about.vue') },
  { path: '/companies', name: 'companies', component: page('companies.vue') },
  { path: '/sailors', name: 'sailors', component: page('sailors.vue') },


  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/welcome', name: 'welcome', component: page('welcome.vue') },

  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  //seamen profile routes
  { path: '/seamen', name: 'seamen', component: page('seamen/index.vue') },
  { path: '/seamen/profile', name: 'seamen.profile', component: page('seamen/index.vue') },
  { path: '/seamen/interviews', name: 'seamen.interviews', component: page('seamen/interviews.vue') },
  { path: '/seamen/interview/invites', name: 'seamen.invite', component: page('seamen/invite.vue') },
  { path: '/seamen/interview/feedback', name: 'seamen.feedback', component: page('seamen/feedback.vue') },
  { path: '/seamen/vacancies', name: 'seamen.vacancies', component: page('seamen/vacancies.vue') },
  { path: '/seamen/information', name: 'seamen.information', component: page('seamen/information.vue') },
  { path: '/seamen/interview/record/:id', name: 'seamen.interview.record', component: page('seamen/record.vue') },
  { path: '/seamen/test', name: 'seamen.interview.test', component: page('seamen/test.vue') },



  //employer profile routes
  { path: '/employer', name: 'employer', component: page('employer/index.vue') },
  { path: '/employer/profile', name: 'employer.profile', component: page('employer/index.vue') },
  { path: '/employer/interviews', name: 'employer.interviews', component: page('employer/interviews.vue') },
  { path: '/employer/interview/invite', name: 'employer.invite', component: page('employer/invite.vue') },
  { path: '/employer/interview/feedback', name: 'employer.feedback', component: page('employer/feedback.vue') },
  { path: '/employer/vacancies', name: 'employer.vacancies', component: page('employer/vacancies.vue') },
  { path: '/employer/vacancy/create', name: 'employer.vacancy.create', component: page('employer/vacancy-create.vue') },
  { path: '/employer/information', name: 'employer.information', component: page('employer/information.vue') },
  { path: '/employer/interview/create', name: 'employer.interview.create', component: page('employer/interview-create.vue') },
]

export function createRouter() {
  return new Router({
    routes,
    scrollBehavior,
    mode: 'history'
  })
}
