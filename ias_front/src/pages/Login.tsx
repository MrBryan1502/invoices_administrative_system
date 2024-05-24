export default function Login() {

  return (<>
    <section className="container mt-5 text-center">
      <div className="row">
        <div className="col-6 offset-3">
          <form className="card p-2">
            <h3>Iniciar Sesión</h3>
            <div className="input-group mb-3">
              <label htmlFor="Email" className="input-group-text text-bg-secondary">Corre electrónico:</label>
              <input id="Email" type="text" className="form-control" />
            </div>
            <div className="input-group mb-3">
              <label htmlFor="Password" className="input-group-text text-bg-secondary">Contraseña:</label>
              <input id="Password" type="text" className="form-control" />
            </div>
            <div>
              <button type="submit" className="btn btn-danger">Iniciar Sesión</button>
            </div>
          </form>
        </div>
      </div>
    </section >
  </>)
}