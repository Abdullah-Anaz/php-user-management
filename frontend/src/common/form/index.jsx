import React from "react";

function Form({ onSubmit, onChangeValue, user, btnText}) {
  return (
    <form onSubmit={onSubmit}>
      <div className="mb-3">
        <label htmlFor="name" className="form-label">
          Name
        </label>
        <input
          type="text"
          className="form-control"
          id="name"
          value={user.name}
          onChange={onChangeValue}
          placeholder="Enter Name"
          autoComplete="off"
          required
        />
      </div>

      <div className="mb-3">
        <label htmlFor="email" className="form-label">
          Email
        </label>
        <input
          type="email"
          className="form-control"
          id="email"
          value={user.email}
          onChange={onChangeValue}
          placeholder="Enter Email"
          autoComplete="off"
          required
        />
      </div>

      <input
        type="submit"
        className="btn btn-primary text-uppercase"
        value={btnText}
      />
    </form>
  );
}

export default Form;
