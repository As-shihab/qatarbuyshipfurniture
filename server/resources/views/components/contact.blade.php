<form action="{{ route('contact.submit') }}" method="POST">
    @csrf

    <div class="tc sf yo ap zf ep qb">
        <div class="vd to/2">
            <label class="rc ac" for="fullname">Full name</label>
            <input type="text" name="fullname" id="fullname" placeholder="Devid Wonder"
                class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
        </div>

        <div class="vd to/2">
            <label class="rc ac" for="email">Email address</label>
            <input type="email" name="email" id="email" placeholder="example@gmail.com"
                class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
        </div>
    </div>

    <div class="tc sf yo ap zf ep qb">
        <div class="vd to/2">
            <label class="rc ac" for="phone">Phone number</label>
            <input type="text" name="phone" id="phone" placeholder="+009 3342 3432"
                class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
        </div>

        <div class="vd to/2">
            <label class="rc ac" for="subject">Subject</label>
            <input type="text" name="subject" id="subject" placeholder="Type your subject"
                class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 xi mi" />
        </div>
    </div>

    <div class="fb">
        <label class="rc ac" for="message">Message</label>
        <textarea placeholder="Message" rows="4" name="message" id="message"
            class="vd ph sg zk xm _g ch pm hm dm dn em pl/50 ci"></textarea>
    </div>

    <div class="tc xf">
        <button type="submit" class="vc rg lk gh ml il hi gi _l">Send Message</button>
    </div>
</form>
