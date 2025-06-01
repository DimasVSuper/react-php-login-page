export default function Button({ children, ...props }) {
  return (
    <button {...props} style={{ padding: '6px 16px', marginTop: 8 }}>
      {children}
    </button>
  );
}