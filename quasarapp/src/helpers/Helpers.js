import { api } from 'boot/axios'
import { useRouter } from 'vue-router'
import moment from 'moment'

export async function validateToken (token) {
  const router = useRouter()
  try {
    const response = await api.get('validToken', { headers: { Authorization: 'Bearer ' + token } })
    return response.data
  } catch (e) {
    console.log(e)
  }
  return await router.push({ name: 'error' })
}

export function generateYears (defaultYear = 70) {
  const years = [moment().format('YYYY')]
  for (let i = 1; i <= defaultYear; i++) {
    years.push((moment().format('YYYY') - i).toString())
  }
  return years
}
