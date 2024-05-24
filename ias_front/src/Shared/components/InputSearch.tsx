interface InputSearchProps {
  onChange: React.ChangeEventHandler<HTMLInputElement>
}

export default function InputSearch({ onChange }: InputSearchProps) {

  return (<>
    <div className="container mb-3">
      <div className="row">
        <div className="col-3">
          <input className="form-control" type="search" placeholder="Buscar..." onChange={onChange} />
        </div>
      </div>
    </div>
  </>)
}