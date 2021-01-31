
export default function ({ store, redirect }) {
  const role = store.getters['auth/role']
  if (!store.getters['auth/check']) {
    return redirect('/login')
  } else if (role !== 'seamen') {
    return redirect('/' + role)
  }
}
