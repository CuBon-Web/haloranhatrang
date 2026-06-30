export function defaultDay() {
  return {
    name: "",
    content: "",
  };
}

export function defaultItinerary() {
  return {
    name: "",
    short_description: "",
    content: "",
    map_image: "",
    featured_image: "",
    days: [defaultDay()],
    sort: "0",
    status: "1",
  };
}

export function normalizeDay(day) {
  return {
    name: day.name || "",
    content: day.content || "",
  };
}

export function normalizeItinerary(item, index) {
  const days = Array.isArray(item.days) ? item.days : [];
  return {
    id: item.id || null,
    name: item.name || "",
    short_description: item.short_description || "",
    content: item.content || "",
    map_image: item.map_image || "",
    featured_image: item.featured_image || "",
    days: days.length ? days.map((day) => normalizeDay(day)) : [defaultDay()],
    sort: item.sort != null ? String(item.sort) : String(index),
    status: item.status != null ? String(item.status) : "1",
  };
}

export function validateItinerary(item) {
  if (!item.name || !item.name.trim()) {
    return "Tên hải trình không được để trống";
  }

  const emptyDay = (item.days || []).some((day) => !day.name || !day.name.trim());
  if (emptyDay) {
    return "Tên lộ trình từng ngày không được để trống";
  }

  return "";
}
