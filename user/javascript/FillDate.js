function FillDate(a){
    console.log(a);
    const  _second = 1000;
    const  _minute = _second * 60;
    const  _hour = _minute * 60;
    const _day = _hour * 24;
    const ele=  document.getElementById('countdown');
    // console.log(ele);
        const distance = Math.abs(a);
        const days = Math.floor(distance / _day);
        const hours = Math.floor((distance % _day) / _hour);
        const minutes = Math.floor((distance % _hour) / _minute);
        const seconds = Math.floor((distance % _minute) / _second);
        // Remaining time
        ele.innerHTML = days + 'days ';
        ele.innerHTML += hours + 'hrs ';
        ele.innerHTML += minutes + 'mins ';
        ele.innerHTML += seconds + 'secs';
        if (a < 0) {
            
            ele.innerHTML += ' late!';
            // add these classes css
            ele.classList.remove("early")
            ele.classList.add("late")
            
            return;
        }
        else{

            ele.innerHTML += ' Remaining';
            ele.classList.remove("late")
            ele.classList.add("early")
        }
    
    }


