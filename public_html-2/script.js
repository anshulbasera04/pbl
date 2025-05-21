document.getElementById("terminalForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const input = document.getElementById("commandInput");
  const command = input.value.trim();
  const outputDiv = document.getElementById("output");
  input.value = "";

  if (command.toLowerCase() === "clear") {
    outputDiv.innerHTML = "";
    return;
  }

  outputDiv.innerHTML += `$ ${command}\n`;

  fetch("process.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "command=" + encodeURIComponent(command)
  })
    .then(response => {
      const contentType = response.headers.get("content-type");
      return contentType && contentType.includes("application/json") ? response.json() : response.text();
    })
    .then(data => {
      if (typeof data === "string") {
        outputDiv.innerHTML += `${data}\n`;
      } else if (data.type === "fcfs") {
        outputDiv.innerHTML += `
  <pre>
Average Waiting Time: ${data.summary.avg_waiting}
Average Turnaround Time: ${data.summary.avg_turnaround}
  </pre>
  ${renderReadyQueue(data.ready_queue)}
  ${renderProcessTable(data.table)}
  ${renderGanttChart(data.chart)}
`;
      }
      outputDiv.scrollTop = outputDiv.scrollHeight;
    })
    .catch(err => outputDiv.innerHTML += `Error: ${err}\n`);
});

function renderGanttChart(chartData) {
  let chart = `<div style="display: flex; margin: 10px 0;">`;
  chartData.forEach(block => {
    const width = (block.end - block.start) * 30;
    chart += `<div style="flex: 0 0 ${width}px; border: 1px solid #999; background: #4caf50; text-align: center; color: white; padding: 5px 0;">${block.name}</div>`;
  });
  chart += `</div><div style="display: flex;">`;
  chartData.forEach(block => {
    const width = (block.end - block.start) * 30;
    chart += `<div style="flex: 0 0 ${width}px; text-align: left;">${block.start}</div>`;
  });
  chart += `<div>${chartData[chartData.length - 1].end}</div></div>`;
  return chart;
}

function renderProcessTable(table) {
  let html = `<h4>📋 Process Table</h4><table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; margin-top: 10px;">
    <tr><th>Process</th><th>Arrival</th><th>Burst</th><th>Start</th><th>End</th><th>Waiting</th><th>Turnaround</th></tr>`;
  table.forEach(row => {
    html += `<tr><td>${row.name}</td><td>${row.arrival}</td><td>${row.burst}</td><td>${row.start}</td><td>${row.end}</td><td>${row.waiting}</td><td>${row.turnaround}</td></tr>`;
  });
  html += `</table>`;
  return html;
}

function renderReadyQueue(queue) {
  let html = `<h4>🕒 Ready Queue</h4><table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; margin-top: 10px;">
    <tr><th>Process</th><th>Arrival</th><th>Burst</th></tr>`;
  queue.forEach(p => {
    html += `<tr><td>${p.name}</td><td>${p.arrival}</td><td>${p.burst}</td></tr>`;
  });
  html += `</table>`;
  return html;
}