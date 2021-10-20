export default function ({ $auth, redirect }) {
  if ($auth.user) {
    if ($auth.user.role !== 'admin') {
      return redirect('/')
    }
  }else{
    return redirect('/')
  }
}

