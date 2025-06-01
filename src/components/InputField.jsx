export default function InputField({ type, value, onChange, placeholder }) {
  return (
    <input
      type={type}
      value={value}
      onChange={onChange}
      placeholder={placeholder}
      required
      style={{ marginBottom: 8, padding: 4 }}
    />
  );
}